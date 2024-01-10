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
<div class="container-fluid">
    <div class="row">
        <!-- Zero Configuration Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>My Files</h5>
                    <span>recently uploaded files.</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Size (KB)</th>
                                    <th>Uploaded</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $files = $db->uploaded_files($_SESSION['user_id']);
                                if ($files['status'] == true) {
                                    foreach ($files['data'] as $file) {
                                        $formattedDate = date('d M Y', strtotime($file['created_at']));
                                        $sizeInKB = round($file['size'] / 1024, 2);
                                        $description = !empty($file['description']) ? $file['description'] : 'No description available';
                                        echo '
                                        <tr>
                                        <td><span class="fa fa-eye"></span> <a href="/f/?hash_id=' . $file['hash_id'] . '">' . $file['title'] . '</a></td>
                                            <td>' . $description . '</td>
                                            <td>' . $sizeInKB . '</td>
                                            <td>' . $formattedDate . '</td>
                                            <td >
                                            <button id="edit-form" hash-id="' . $file['hash_id'] . '" class="btn btn-info btn-lg"><span class="fa fa-edit"></span> </button>
                                            <button type="button" id="delete-file" hash-id="' . $file['hash_id'] . '" class="btn btn-danger btn-lg"><span class="fa fa-trash"></span> </button>
                                            
                                            </td>
                                        </tr>
                                        ';
                                    }
                                } else {
                                    echo '<tr><td colspan="5">No files found</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration Ends-->
    </div>
</div>