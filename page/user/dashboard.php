<?php
function time_ago($timestamp)
{
    $current_time = time();
    $time_difference = $current_time - strtotime($timestamp);
    $seconds = $time_difference;
    $minutes      = round($seconds / 60);           // value 60 is seconds
    $hours           = round($seconds / 3600);           // value 3600 is 60 minutes * 60 sec
    $days          = round($seconds / 86400);          // value 86400 is 24 hours * 60 minutes * 60 sec
    $weeks       = round($seconds / 604800);          // value 604800 is 7 days * 24 hours * 60 minutes * 60 sec
    $months    = round($seconds / 2629440);      // value 2629440 is ((365+365+365+365+366)/5/12) days * 24 hours * 60 minutes * 60 sec
    $years      = round($seconds / 31553280);     // value 31553280 is ((365+365+365+365+366)/5) days * 24 hours * 60 minutes * 60 sec
    if ($seconds <= 60) {
        return "Just Now";
    } else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hrs ago";
        }
    } else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    } else if ($weeks <= 4.3) {  // 4.3 == 30/7
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    } else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    } else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}
?>

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
    <div class="row ">
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-primary o-hidden">
                <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                        <div class="media-body"><span class="m-0 text-white">Uploaded Files</span>
                            <h4 class="mb-0 counter"><?php echo $db->count_all_uploaded_files() ?></h4><i class="icon-bg" data-feather="database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-secondary o-hidden">
                <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="download-cloud"></i></div>
                        <div class="media-body"><span class="m-0">Downloaded</span>
                            <h4 class="mb-0 counter"><?php echo $db->get_total_downloads() ?></h4><i class="icon-bg" data-feather="download-cloud"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-warning o-hidden">
                <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <div class="text-white i" data-feather="link-2"></div>
                        </div>
                        <div class="media-body"><span class="m-0 text-white">Total Task</span>
                            <h4 class="mb-0 counter text-white"><?php echo $db->count_total_tasks() ?></h4><i class="icon-bg" data-feather="link-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
            <div class="card gradient-info o-hidden">
                <div class="b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <div class="text-white i" data-feather="user-plus"></div>
                        </div>
                        <div class="media-body"><span class="m-0 text-white">Registered Users</span>
                            <h4 class="mb-0 counter text-white"><?php echo $db->count_total_users() ?></h4><i class="icon-bg" data-feather="user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 xl-100 box-col-12">
            <div class="card o-hidden">
                <div class="cal-date-widget card-body p-0">
                    <div class="row">
                        <div class="col-xl-5 col-xs-12 col-md-6 col-sm-12 gradient-primary">
                            <div class="cal-info text-center">
                                <h2>24</h2>
                                <div class="d-inline-block mt-2"><span class="b-r-light pr-3"><?php echo date("M"); ?></span><span class="pl-3"><?php echo date("Y"); ?></span></div>
                                <ul class="task-list">
                                    <li> Beatiful Day </li>
                                    <li> Upload Your File Today</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-7 col-xs-12 col-md-6 col-sm-12 p-50">
                            <div class="cal-datepicker">
                                <div class="datepicker-here" data-language="en"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 box-col-12 xl-100">
            <div class="card">
                <div class="card-header no-border">
                    <h5>Recent Uploaded Files</h5>
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
                <div class="card-body pt-0">
                    <div class="activity-table table-responsive">
                        <table class="table table-bordernone">
                            <tbody>
                                <?php
                                $recentlyUploadedFiles = $db->get_recently_uploaded_files(2);
                                foreach ($recentlyUploadedFiles as $file) {
                                ?>
                                    <tr>
                                        <td>
                                            <div class="activity-image"><img class="img-fluid" src="../assets/images/dashboard/clipboard.png" alt=""></div>
                                        </td>
                                        <td>
                                            <div class="activity-details">
                                                <h4 class="default-text"><?= date('d', strtotime($file['created_at'])); ?> <span class="f-14"><?= date('M', strtotime($file['created_at'])); ?></span></h4>
                                                <h6><?= $file['name']; ?></h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="activity-time"><span class="font-primary f-w-700"><?= time_ago($file['created_at']); ?></span><span class="d-block light-text">Downloaded : <?= $file['downloaded']; ?></span></div>
                                        </td>
                                        <td>
                                            <a href="index.php?page=uploaded" class="btn btn-shadow-primary">View</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>