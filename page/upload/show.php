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
                    <li class="breadcrumb-item">PDF</li>
                    <li class="breadcrumb-item">Daftar Dokumen</li>
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
                    <h5>Zero Configuration</h5>
                    <span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span>
                    <span>Searching, ordering, and paging goodness will be immediately added to the table, as shown in this example.</span>
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
                                        <td><a href="terngehekngehek">' . $file['name'] . '</a></td>
                                            <td>' . $description . '</td>
                                            <td>' . $sizeInKB . '</td>
                                            <td>' . $formattedDate . '</td>
                                            <td>
                                                <button class="btn btn-sm btn-info">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
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