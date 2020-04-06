<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php element( 'header' ); ?>

<div class="col">

  <div class="row">
    <div class="col">
      <a class="btn btn-success btn-sm mb-2" href="<?php echo SITE_URL ?>/?page=add_person" title="Add New Person">
        <svg class="bi bi-person-plus" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM6 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zm4.5 0a.5.5 0 01.5.5v2a.5.5 0 01-.5.5h-2a.5.5 0 010-1H13V5.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
          <path fill-rule="evenodd" d="M13 7.5a.5.5 0 01.5-.5h2a.5.5 0 010 1H14v1.5a.5.5 0 01-1 0v-2z" clip-rule="evenodd"/>
        </svg>
      </a>

      <a class="btn btn-primary btn-sm mb-2" href="<?php echo SITE_URL ?>/?page=persons" title="Refresh">
        <svg class="bi bi-arrow-clockwise" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3.17 6.706a5 5 0 017.103-3.16.5.5 0 10.454-.892A6 6 0 1013.455 5.5a.5.5 0 00-.91.417 5 5 0 11-9.375.789z" clip-rule="evenodd"/>
          <path fill-rule="evenodd" d="M8.147.146a.5.5 0 01.707 0l2.5 2.5a.5.5 0 010 .708l-2.5 2.5a.5.5 0 11-.707-.708L10.293 3 8.147.854a.5.5 0 010-.708z" clip-rule="evenodd"/>
        </svg>
      </a>
    </div>
    <div class="col">
      <form method="get">
        <input type="hidden" name="page" value="persons">
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>
          <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Search" name="s">
        </div>
      </form>
    </div>    
  </div>  

  <?php 

    $search = isset( $_GET[ 's' ] ) && !empty( $_GET[ 's' ] ) ? 'WHERE CONCAT( p.firstname, " ", p.middlename, " ", p.lastname ) LIKE "%' . clean( $_GET[ 's' ] ) . '%"': '';

    /* PAGINATION */
    $p = isset( $_GET[ 'p' ] ) ? clean( $_GET[ 'p' ] ) : 1;
    $total_page = 20;
    $start_limit = ( $p - 1 ) * $total_page;    
    $max = $DB->query( "SELECT COUNT(*) FROM persons AS p $search" ); 
    $max = $max->fetch_array();
    $max_page = ceil( $max[0] / $total_page );

    /*echo $p . " - " . $max_page;
    var_dump($p >= $max_page);*/
    /* END of PAGINATION */    

    $q = "SELECT id, firstname, middlename, lastname, status, extension, (SELECT COUNT(*) FROM contact_traces AS CT WHERE CT.contacted_person_id=P.id) AS contacted, ( SELECT contacted_person_id FROM contact_traces WHERE person_id = P.id LIMIT 1 ) AS contacted_person_id, ( SELECT CONCAT( firstname, ' ', middlename, ' ', lastname ) FROM persons WHERE id = contacted_person_id ) AS contacted_person_name FROM persons AS P $search LIMIT $start_limit, $total_page";

    $accounts = $DB->query( $q );
    $num = 1 + ( ( $p - 1 ) * $total_page );
  ?>
  <table class="table table-striped table-hover table-sm" style="font-size: 12px;">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Contacted<br>By</th>
        <th>Contacted<br>People</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>    
    <tbody>
    <?php if( $accounts && $accounts->num_rows ) { ?>
      <?php while( $account = $accounts->fetch_object() ) : ?>
      <tr>
        <td><?php echo $num ?></td>
        <td><span style="text-transform: capitalize;"><?php echo $account->firstname . ' ' . $account->middlename . ' ' . $account->lastname ?></span> <?php echo ( isset( $account->extension ) && !empty( $account->extension ) ? "({$account->extension})" : '' ) ?></td>
        <td>
          <?php if( $account->contacted_person_id ) : ?>
          <a style="font-size: 12px;" class="btn btn-danger btn-sm" href="<?php echo SITE_URL ?>/?page=contacted&person_id=<?php echo $account->contacted_person_id ?>" title="Contacted by <?php echo $account->contacted_person_name ?>">
            <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM8 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"/>
            </svg>            
          </a>
          <?php endif; ?>   
        </td>
        <td>
          <?php //if( $account->contacted ): ?>
          <a class="btn btn-secondary btn-sm" href="<?php echo SITE_URL ?>/?page=contacted&person_id=<?php echo $account->id ?>" title="View of contacted persons">
            <svg class="bi bi-list-ul" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5 11.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm-3 1a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
            </svg>                                 
          </a>
          <span class="badge badge-warning" title="Number of contacted persons"><?php echo $account->contacted ?></span>
          
          <?php //endif; ?>    
        </td>
        <td style="text-transform: uppercase;"><?php echo $account->status ?></td>
        <td>
          <a class="btn btn-info btn-sm" href="<?php echo SITE_URL ?>/?page=edit_person&id=<?php echo $account->id ?>" title="View/Update Person Details">
            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
              <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
            </svg>
          </a>          
        </td>        
      </tr>
      <?php $num++; endwhile; ?>
    <?php } else { ?>
      <tr>
        <td colspan="5">No records found.</td>
      </tr>
    <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item <?php echo ( $p <= 1 ? 'disabled' : '' ) ?>">
                <a class="page-link" href="<?php echo SITE_URL ?>/?page=persons&p=<?php echo ( ( $p > 1 ) ? $p - 1 : 1 ) ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>              
              <li class="page-item <?php echo ( ( $p >= $max_page ) ? 'disabled' : '' ) ?>">
                <a class="page-link" href="<?php echo SITE_URL ?>/?page=persons&p=<?php echo ( $p + 1 ) ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </td>
      </tr>
    </tfoot> 
  </table>
</div>
<?php element( 'footer' ); ?>

