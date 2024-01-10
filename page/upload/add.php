<div class="container-fluid">
  <div class="page-header">
    <div class="row">
      <div class="col-lg-6 main-header">
        <h2>Upload Files</h2>
      </div>
      <div class="col-lg-6 breadcrumb-right">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">
              <i class="pe-7s-home"></i>
            </a>
          </li>
          <li class="breadcrumb-item">Upload</li>
          <li class="breadcrumb-item">Upload Page</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">

          <h5>Upload Now</h5>
          <span>Upload your files today!</span>
        </div>
        <div class="card-block">

          <div class="card-body">
            <form action="<?php echo $uploadFile; ?>" enctype="multipart/form-data" method="POST" class="theme-form">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <?php echo isset($_SESSION['alert']) ? $_SESSION['alert'] : '';
                    unset($_SESSION['alert']); ?>
                    <label for="pdf_name">Title</label>
                    <input class="form-control input-air-primary" name="title" id="filename" placeholder="Calculus" type="text">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control input-air-primary" name="desc" id="desc" placeholder="Calculus" rows="3"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="filetoUpload">Upload File</label>
                    <input type="file" id="filetoUpload" name="fileToUpload" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="form-group m-t-15 m-checkbox-inline m-b-10 custom-radio-ml ">
                    <div class="radio radio-primary">
                      <input id="private" type="radio" name="private" value="1">
                      <label class="mb-0" for="private">Private</label>
                    </div>
                    <div class="radio radio-primary">
                      <input id="public" type="radio" name="private" value="0">
                      <label class="mb-0" for="public">Public</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div id="form-password" class="form-group m-t-15">
                    <label for="desc">Password : </label>
                    <input name="password" class="form-control input-air-primary" id="desc" placeholder="SecretPass!">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="submit" class="btn btn-primary">Upload </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>