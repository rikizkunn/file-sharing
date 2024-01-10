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
                        <h5>Download <?php echo $fileInfo['name']; ?></h5>
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

                        <form action="" method="POST" class="theme-form">
                            <div class="row justify-content-center">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <div class="text-center">
                                            <h7 class="f-w-700"> Password required to download this files </h7>
                                        </div>
                                        <hr>
                                        <?php echo $alert; ?>
                                        <label for="password_file">Password</label>
                                        <input name="password_file" class="form-control input-air-primary" id="password_file" type="text">
                                        <button type="submit" class="btn btn-md btn-primary m-t-20 btn-block">Unlock</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>