<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>My Files</h2>
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i class="pe-7s-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Upload</li>
                        <li class="breadcrumb-item">My Files</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid m-t-50">
        <div class="row justify-content-center">
            <!-- Zero Configuration Starts-->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header no-border">
                        <h5>Download <?php echo $fileInfo['title']; ?></h5>
                        <ul class="creative-dots">
                            <li class="bg-primary big-dot"></li>
                            <li class="bg-secondary semi-big-dot"></li>
                            <li class="bg-warning medium-dot"></li>
                            <li class="bg-info semi-medium-dot"></li>
                            <li class="bg-secondary semi-small-dot"></li>
                            <li class="bg-primary small-dot"></li>
                        </ul>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-gear fa fa-spin font-primary"></i></li>
                                <li><i class="view-html fa fa-code font-primary"></i></li>
                                <li><i class="icofont icofont-maximize full-card font-primary"></i></li>
                                <li><i class="icofont icofont-minus minimize-card font-primary"></i></li>
                                <li><i class="icofont icofont-refresh reload-card font-primary"></i></li>
                                <li><i class="icofont icofont-error close-card font-primary"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="sales-product-table crypto-table-market table-responsive">
                            <table class="table table-bordernone">
                                <tbody>
                                    <tr>
                                        <td class="font-danger f-w-700">Name</td>
                                        <td><span class="f-w-700"><?php echo $fileInfo['name']; ?> </span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-primary f-w-700">Author</td>
                                        <td><span class="badge rounded-pill f-16 font-primary"><?php echo $fileInfo['username']; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-success f-w-700">Size</td>
                                        <td><span class="badge rounded-pill f-16 font-success"><?php echo $sizeInKB; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-secondary f-w-700">Uploaded</td>
                                        <td><span class="f-w-700"><?php echo $formattedDate; ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <form method="POST" action="/api/download.php?hash_id=<?php echo $fileInfo['hash_id']; ?>">
                            <p class="f-w-500"> <?php echo $description; ?> </p>
                            <input type="hidden" name="password_file" value="<?php echo isset($userInputPassword) ? $userInputPassword : ''; ?>">
                            <button type="submit" class="btn btn-primary btn-block">
                                Download Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>