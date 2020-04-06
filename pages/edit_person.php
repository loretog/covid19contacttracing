<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php element( 'header' ); ?>

<div class="col">
  
  <div class="row mb-2">
    <div class="col-9">
      <h5>Update Person</h5>  
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

  <?php
    $id = isset( $_GET[ 'id' ] ) && !empty( $_GET[ 'id' ] ) ? clean( $_GET[ 'id' ] ) : null;
    $account = $DB->query( "SELECT * FROM persons WHERE id = $id LIMIT 1" );    
  ?>

  <?php if( $account && $account->num_rows ) { 
    $account = $account->fetch_object();   
  ?>
  <div class="alert alert-warning" role="alert">
    Note: Make sure you have the Patient's consent before adding their info.
  </div>
  <form method="post">
    <input type="hidden" name="action" value="update_person">
    <input type="hidden" name="id" value="<?php echo $_GET[ 'id' ] ?>">
    <div class="form-group">
      <label for="exampleInputEmail1">First Name</label>
      <input type="text" name="data[firstname]" class="form-control" required value="<?php echo $account->firstname ?>">      
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Middle Name</label>
      <input type="text" name="data[middlename]" class="form-control" required value="<?php echo $account->middlename ?>">      
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Last Name</label>
      <input type="text" name="data[lastname]" class="form-control" required value="<?php echo $account->lastname ?>">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Extension</label>
      <input type="text" name="data[extension]" class="form-control" value="<?php echo $account->extension ?>">      
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Status</label>
      <select name="data[status]" class="custom-select">
        <option value="pum" <?php echo $account->status == 'pum' ? 'selected' : '' ?>>PUM (Person Under Monitoring)</option>
        <option value="pui" <?php echo $account->status == 'pui' ? 'selected' : '' ?>>PUI (Person Under Investigation)</option>
        <option value="rcvrd" <?php echo $account->status == 'recovered' ? 'selected' : '' ?>>Recovered</option>
      </select>
    </div>
    
    <button type="submit" class="btn btn-success btn-sm" title="Save Person">
      <svg class="bi bi-person-check" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M11 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM1.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM6 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0zm6.854.146a.5.5 0 010 .708l-3 3a.5.5 0 01-.708 0l-1.5-1.5a.5.5 0 01.708-.708L12.5 7.793l2.646-2.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
      </svg>
    </button>
  </form>  
  <?php } else { ?>
    <div class="alert alert-danger" role="alert">
      Account not found
  </div>
  <?php } ?>
</div>
<?php element( 'footer' ); ?>

