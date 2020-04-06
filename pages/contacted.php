<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php element( 'header' ); ?>

<div class="col">  

  <?php 
    $contacted_person_id = $_GET[ 'person_id' ];

    $person = $DB->query( "SELECT * FROM persons AS P WHERE P.id = $contacted_person_id" );

    if( $person->num_rows ) :
      $person = $person->fetch_object();
  ?>
    
  <div class="row">
    <div class="col-9">
      <h5 style="text-transform: capitalize;"><?php echo $person->firstname . " " . $person->middlename . " " . $person->lastname . " " . $person->extension ?></h5>  
    </div>
    <div class="col d-flex justify-content-end">
      <a class="btn btn-primary" href="<?php echo SITE_URL ?>/?page=persons" title="Back">
        <svg class="bi bi-arrow-left-short" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M7.854 4.646a.5.5 0 010 .708L5.207 8l2.647 2.646a.5.5 0 01-.708.708l-3-3a.5.5 0 010-.708l3-3a.5.5 0 01.708 0z" clip-rule="evenodd"/>
          <path fill-rule="evenodd" d="M4.5 8a.5.5 0 01.5-.5h6.5a.5.5 0 010 1H5a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
        </svg>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <a class="btn btn-success" href="<?php echo SITE_URL ?>/?page=add_person&contacted_person_id=<?php echo $person->id ?>" title="Add Contacted People">
        <svg class="bi bi-people" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.995-.944v-.002.002zM7.022 13h7.956a.274.274 0 00.014-.002l.008-.002c-.002-.264-.167-1.03-.76-1.72C13.688 10.629 12.718 10 11 10c-1.717 0-2.687.63-3.24 1.276-.593.69-.759 1.457-.76 1.72a1.05 1.05 0 00.022.004zm7.973.056v-.002.002zM11 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zM6.936 9.28a5.88 5.88 0 00-1.23-.247A7.35 7.35 0 005 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 015 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10c-1.668.02-2.615.64-3.16 1.276C1.163 11.97 1 12.739 1 13h3c0-1.045.323-2.086.92-3zM1.5 5.5a3 3 0 116 0 3 3 0 01-6 0zm3-2a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd"/>
        </svg>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      Status: <span style="text-transform: uppercase;"><?php echo $person->status ?></span>
    </div>
  </div>
  <?php

    $accounts = $DB->query( "SELECT *, (SELECT COUNT(*) FROM contact_traces AS CT WHERE CT.contacted_person_id=P.id) AS contacted FROM contact_traces AS CT LEFT JOIN persons AS P ON CT.person_id=P.id WHERE contacted_person_id = $contacted_person_id" );    
  ?>  
  <table class="table table-striped table-hover table-sm" style="font-size: 12px;">
    <thead>
      <tr>
        <th colspan="5" style="text-align: center;">List of Contacted People - <?php echo $accounts->num_rows ?></th>
      </tr>
      <tr>      
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>    
    <tbody>
    <?php if( $accounts->num_rows ) : ?>
      <?php while( $account = $accounts->fetch_object() ) : ?>
      <tr>
        <td><?php echo $account->firstname ?></td>
        <td><?php echo $account->middlename ?></td>
        <td><?php echo $account->lastname ?></td>      
        <td><?php echo $account->status ?></td>   
        <td>
          <a class="btn btn-info btn-sm" href="<?php echo SITE_URL ?>/?page=edit_person&id=<?php echo $account->id ?>" title="View/Update Person Details">
            <svg class="bi bi-pencil" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 011.414 0l2 2a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z" clip-rule="evenodd"/>
              <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 00.5.5H4v.5a.5.5 0 00.5.5H5v.5a.5.5 0 00.5.5H6v-1.5a.5.5 0 00-.5-.5H5v-.5a.5.5 0 00-.5-.5H3z" clip-rule="evenodd"/>
            </svg>
          </a>
          <a class="btn btn-secondary btn-sm" href="<?php echo SITE_URL ?>/?page=contacted&person_id=<?php echo $account->id ?>">
            <svg class="bi bi-list-ul" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M5 11.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm-3 1a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2zm0 4a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
            </svg>
          </a>
          <span class="badge badge-warning" title="Number of contacted persons">
            <?php echo $account->contacted ?>
          </span>
        </td>        
      </tr>
      <?php endwhile ?>
    <?php else: ?>
      <tr>
        <td colspan="5">No contacts found!</td>        
      </tr>
    <?php endif; ?>
    </tbody>    
  </table>

  <?php else : ?>
    Record not found
  <?php endif; ?>
</div>
<?php element( 'footer' ); ?>

