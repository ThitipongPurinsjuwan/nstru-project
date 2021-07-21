<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
/* @var $this \yii\web\View */
/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);

if (empty($_SESSION['user_id'])) {
    echo "<script>window.location='index.php?r=site/logout_clear'</script>";
}

$menu = Yii::$app->db->createCommand("SELECT * FROM `user_role` WHERE id = '".$_SESSION['user_role']."'")->queryOne();
$menu_main_role = str_replace('[', '', $menu['allow_access_main']);
$menu_main_role = str_replace(']', '', $menu_main_role);
$menu_main_role = str_replace('"', '\'', $menu_main_role);

if (!empty($menu_main_role)) {
    $where_main_id = "AND id IN (".$menu_main_role.")";
}else{
    $where_main_id = "";
}

$menu_sub_role = str_replace('[', '', $menu['allow_access_sub']);
$menu_sub_role = str_replace(']', '', $menu_sub_role);
$menu_sub_role = str_replace('"', '\'', $menu_sub_role);

if (!empty($menu_sub_role)) {
    $where_sub_id = "AND submenu_id IN (".$menu_sub_role.")";
}else{
    $where_sub_id = "";
}

$ALL_URL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$PHP_SELF = explode("/", $ALL_URL);
$rr = array_slice($PHP_SELF,4);
$r_url = implode("/",$rr);

$check_isn_database_main = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `menu_main` WHERE m_link = '".$r_url."'")->queryScalar();

$check_isn_database_sub = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `menu_sub` WHERE submenu_link = '".$r_url."'")->queryScalar();

$check_isn_database = $check_isn_database_sub + $check_isn_database_main;

if ($check_isn_database>0) {
    if (!empty($where_main_id)) {
        $check_url_main = Yii::$app->db->createCommand("SELECT * FROM `menu_main` WHERE m_link != '' AND m_status = 'Y' $where_main_id")->queryAll();

        $check_main_count = 0;
        foreach ($check_url_main as $url_main) {
            if (strstr( $ALL_URL, $url_main['m_link'] ) ) {
                $check_main_count = $check_main_count + 1;
            } else {
                $check_main_count = $check_main_count + 0;
            }
        }
    }else{
        $check_main_count = 0;
    }


    if (!empty($where_sub_id)) {
        $check_url_sub = Yii::$app->db->createCommand("SELECT * FROM `menu_sub` WHERE submenu_active = 'Y' $where_sub_id")->queryAll();
        $check_sub_count = 0;
        foreach ($check_url_sub as $url_sub) {
            if (strstr( $ALL_URL, $url_sub['submenu_link'] ) ) {
                $check_sub_count = $check_sub_count + 1;
            } else {
                $check_sub_count = $check_sub_count + 0;
            }
        }
    }else{
        $check_sub_count = 0;
    }

    $check_all_count =  $check_main_count+$check_sub_count;


    if ($check_all_count==0) {
        echo "<script>window.location='index.php?r=site/pages&view=alert_permission'</script>";
    }

}

?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>" dir="ltr">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <?php $this->registerCsrfMetaTags();?>
    <title><?= Html::encode($this->title);?></title>
    <?php $this->head();?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="../../html-version/assets/plugins/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../html-version/assets/plugins/multi-select/css/multi-select.css">
    <!-- Plugins css -->
    <link rel="stylesheet" href="../../html-version/assets/plugins/charts-c3/c3.min.css"/>
    <link rel="stylesheet" href="../../html-version/assets/plugins/dropify/css/dropify.min.css">
    
    <!-- Core css -->
    <link rel="stylesheet" href="../../html-version/assets/css/main.css"/>
    <link rel="stylesheet" href="../../html-version/assets/css/theme1.css"/>
    <!-- style by pd -->
    <link rel="stylesheet" href="../../html-version/assets/css/style.css"/>

    <script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
</head>
<body class="font-montserrat sidebar_dark">
    <?php $this->beginBody() ?>

    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>

    <div id="main_content">

        <div id="header_top" class="header_top">
            <div class="container">
                <div class="hleft">
                    <a class="header-brand" href="index.php"><i class="fe fe-home brand-logo"></i></a>
                    <div class="dropdown">
                        <a href="index.php?r=site/page-search" class="nav-link icon"><i class="fa fa-search"></i></a>                    
                        <a href="app-calendar.html"  class="nav-link icon app_inbox"><i class="fa fa-calendar"></i></a>
                        <a href="app-contact.html"  class="nav-link icon xs-hide"><i class="fa fa-id-card-o"></i></a>
                        <a href="app-chat.html"  class="nav-link icon xs-hide"><i class="fa fa-comments-o"></i></a>
                        <a href="index.php?r=site/pages&view=file-manager"  class="nav-link icon app_file xs-hide"><i class="fa fa-folder-o"></i></a> 
                        <a href="index.php?r=site/pages&view=map"  class="nav-link icon xs-hide"><i class="fa fa-map-marker"></i></a>
                        <a href="index.php?r=site/pages&view=app-chart"  class="nav-link icon xs-hide"><i class="fa fa-signal"></i></a>
                        <a href="index.php?r=site/pages&view=network-link"  class="nav-link icon xs-hide"><i class="fa fa-connectdevelop"></i></a>
                        <a href="index.php?r=site/pages&view=redis"  class="nav-link icon xs-hide"><i class="fa fa-server"></i></a>
                        <a href="index.php?r=file-upload-list"  class="nav-link icon xs-hide"><i class="fa fa-file"></i></a>
                        <a href="index.php?r=setting"  class="nav-link icon xs-hide"><i class="fa fa-cog"></i></a>
                        <a href="index.php?r=site/logout_clear"  class="nav-link icon xs-hide"><i class="fa fa-power-off"></i></a>
                        
                        
                    </div>
                </div>
                <div class="hright">
                    <div class="dropdown">
                        <!-- <a href="javascript:void(0)" class="nav-link icon theme_btn"><i class="fa fa-paint-brush" data-toggle="tooltip" data-placement="right" title="Themes"></i></a> -->
                        <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-gear fa-spin" data-toggle="tooltip" data-placement="right" title="Settings"></i></a>
                        <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="../../html-version/assets/images/user.png" alt="" data-toggle="tooltip" data-placement="right" title="User Menu"/></a>
                        <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>
                    </div>            
                </div>
            </div>
        </div>

        <div id="rightsidebar" class="right_sidebar">
            <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings" aria-expanded="true">Settings</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity" aria-expanded="false">Activity</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane vivify fadeIn active" id="Settings" aria-expanded="true">
                    <div class="mb-4">
                        <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                        <div class="custom-controls-stacked font_setting">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-opensans">
                                <span class="custom-control-label">Open Sans Font</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-montserrat" checked="">
                                <span class="custom-control-label">Montserrat Google Font</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="font" value="font-roboto">
                                <span class="custom-control-label">Robot Google Font</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="font-14 font-weight-bold text-muted">Dropdown Menu Icon</h6>
                        <div class="custom-controls-stacked arrow_option">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="marrow" value="arrow-a">
                                <span class="custom-control-label">A</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                                <span class="custom-control-label">B</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="marrow" value="arrow-c" checked="">
                                <span class="custom-control-label">C</span>
                            </label>
                        </div>
                        <h6 class="font-14 font-weight-bold mt-4 text-muted">SubMenu List Icon</h6>
                        <div class="custom-controls-stacked list_option">
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                                <span class="custom-control-label">A</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                                <span class="custom-control-label">B</span>
                            </label>
                            <label class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                                <span class="custom-control-label">C</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                        <ul class="setting-list list-unstyled mt-1 setting_switch">
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Night Mode</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Fix Navbar top</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Header Dark</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Min Sidebar Dark</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Sidebar Dark</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar" checked="">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Icon Color</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Gradient Color</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Box Shadow</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">RTL Support</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                            <li>
                                <label class="custom-switch">
                                    <span class="custom-switch-description">Box Layout</span>
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="d-block">Storage <span class="float-right">77%</span></label>
                        <div class="progress progress-sm">
                            <div class="progress-bar" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                        <button type="button" class="btn btn-primary btn-block mt-3">Upgrade Storage</button>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane vivify fadeIn" id="activity" aria-expanded="false">
                    <ul class="new_timeline mt-3">
                        <li>
                            <div class="bullet pink"></div>
                            <div class="time">11:00am</div>
                            <div class="desc">
                                <h3>Attendance</h3>
                                <h4>Computer Class</h4>
                            </div>
                        </li>
                        <li>
                            <div class="bullet pink"></div>
                            <div class="time">11:30am</div>
                            <div class="desc">
                                <h3>Added an interest</h3>
                                <h4>“Volunteer Activities”</h4>
                            </div>
                        </li>
                        <li>
                            <div class="bullet green"></div>
                            <div class="time">12:00pm</div>
                            <div class="desc">
                                <h3>Developer Team</h3>
                                <h4>Hangouts</h4>
                                <ul class="list-unstyled team-info margin-0 p-t-5">                                            
                                    <li><img src="../../html-version/assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    <li><img src="../../html-version/assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    <li><img src="../../html-version/assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                    <li><img src="../../html-version/assets/images/xs/avatar4.jpg" alt="Avatar"></li>                                            
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="bullet green"></div>
                            <div class="time">2:00pm</div>
                            <div class="desc">
                                <h3>Responded to need</h3>
                                <a href="javascript:void(0)">“In-Kind Opportunity”</a>
                            </div>
                        </li>
                        <li>
                            <div class="bullet orange"></div>
                            <div class="time">1:30pm</div>
                            <div class="desc">
                                <h3>Lunch Break</h3>
                            </div>
                        </li>
                        <li>
                            <div class="bullet green"></div>
                            <div class="time">2:38pm</div>
                            <div class="desc">
                                <h3>Finish</h3>
                                <h4>Go to Home</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="theme_div">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-unstyled">
                        <li class="list-group-item mb-2">
                            <p>Default Theme</p>
                            <a href="../main/index.html"><img src="../../html-version/assets/images/themes/default.png" class="img-fluid" /></a>
                        </li>
                        <li class="list-group-item mb-2">
                            <p>Night Mode Theme</p>
                            <a href="../dark/index.html"><img src="../../html-version/assets/images/themes/dark.png" class="img-fluid" /></a>
                        </li>                    
                        <li class="list-group-item mb-2">
                            <p>RTL Version</p>
                            <a href="../rtl/index.html"><img src="../../html-version/assets/images/themes/rtl.png" class="img-fluid" /></a>
                        </li>
                        <li class="list-group-item mb-2">
                            <p>Theme Version2</p>
                            <a href="../theme2/index.html"><img src="../../html-version/assets/images/themes/theme2.png" class="img-fluid" /></a>
                        </li>
                        <li class="list-group-item mb-2">
                            <p>Theme Version3</p>
                            <a href="../theme3/index.html"><img src="../../html-version/assets/images/themes/theme3.png" class="img-fluid" /></a>
                        </li>
                        <li class="list-group-item mb-2">
                            <p>Theme Version4</p>
                            <a href="../theme4/index.html"><img src="../../html-version/assets/images/themes/theme4.png" class="img-fluid" /></a>
                        </li>
                        <li class="list-group-item mb-2">
                            <p>Horizontal Version</p>
                            <a href="../horizontal/index.html"><img src="../../html-version/assets/images/themes/horizontal.png" class="img-fluid" /></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="user_div">
            <h5 class="brand-name mb-4">Text X<a href="javascript:void(0)" class="user_btn"><i class="icon-logout"></i></a></h5>
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <img class="avatar avatar-xl mr-3" src="../../html-version/assets/images/sm/avatar1.jpg" alt="avatar">
                        <div class="media-body">
                            <h5 class="m-0">Sara Hopkins</h5>
                            <p class="text-muted mb-0">Webdeveloper</p>
                            <ul class="social-links list-inline mb-0 mt-2">
                                <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)" title="" data-toggle="tooltip" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statistics</h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>                                
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 pb-3">
                                <label class="mb-0">Balance</label>
                                <h4 class="font-30 font-weight-bold">$545</h4>
                            </div>
                            <div class="col-6 pb-3">
                                <label class="mb-0">Growth</label>
                                <h4 class="font-30 font-weight-bold">27%</h4>
                            </div>
                        </div>
                    </div>                
                    <div class="form-group">
                        <label class="d-block">Total Income<span class="float-right">77%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Total Expenses <span class="float-right">50%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="d-block">Gross Profit <span class="float-right">23%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Friends</h3>
                    <div class="card-options">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>                                
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">                
                    <ul class="right_chat list-unstyled">
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="../../html-version/assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Donald Gardner</span>
                                        <span class="message">Designer, Blogger</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="../../html-version/assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Wendy Keen</span>
                                        <span class="message">Java Developer</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="../../html-version/assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">Matt Rosales</span>
                                        <span class="message">CEO, Epic Theme</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>                            
                        </li>                      
                    </ul>
                </div>
            </div>
            <div class="card b-none">
                <ul class="list-group">
                    <li class="list-group-item d-flex">
                        <div class="box-icon sm rounded bg-blue"><i class="fa fa-credit-card"></i> </div>
                        <div class="ml-3">
                            <div>+$29 New sale</div>
                            <a href="javascript:void(0)">Admin Template</a>
                            <div class="text-muted font-12">5 min ago</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="box-icon sm rounded bg-pink"><i class="fa fa-upload"></i> </div>
                        <div class="ml-3">
                            <div>Project Update</div>
                            <a href="javascript:void(0)">New HTML page</a>
                            <div class="text-muted font-12">10 min ago</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="box-icon sm rounded bg-teal"><i class="fa fa-file-word-o"></i> </div>
                        <div class="ml-3">
                            <div>You edited the file</div>
                            <a href="javascript:void(0)">reposrt.doc</a>
                            <div class="text-muted font-12">11 min ago</div>
                        </div>
                    </li>
                    <li class="list-group-item d-flex">
                        <div class="box-icon sm rounded bg-cyan"><i class="fa fa-user"></i> </div>
                        <div class="ml-3">
                            <div>New user</div>
                            <a href="javascript:void(0)">Puffin web - view</a>
                            <div class="text-muted font-12">17 min ago</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div id="left-sidebar" class="sidebar ">
            <h5 class="brand-name">Text X <a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul class="metismenu">
                    <!-- <li class="g_heading"><?php echo $_SESSION['user_id']; ?></li> -->
                    <!--  <li class="g_heading">Directories</li> -->
<!-- <li class="active">
<a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-rocket"></i><span>HRMS</span></a>
<ul>

    <li class="active"><a href="index.html"><span>Dashboard</span></a></li>
    <li><a href="hr-users.html"><span>Users</span></a></li>
    <li><a href="hr-departments.html"><span>Departments</span></a></li>
    <li><a href="hr-employee.html"><span>Employee</span></a></li>
    <li><a href="hr-activities.html"><span>Activities</span></a></li>
    <li><a href="hr-holidays.html"><span>Holidays</span></a></li>
    <li><a href="hr-events.html"><span>Events</span></a></li>
    <li><a href="hr-payroll.html"><span>Payroll</span></a></li>
    <li><a href="hr-accounts.html"><span>Accounts</span></a></li>
    <li><a href="hr-report.html"><span>Report</span></a></li>
</ul>
</li> -->
<!-- <?php 
$array_menu_main = Yii::$app->db->createCommand("SELECT * FROM `menu_main` WHERE m_status = 'Y' ORDER BY m_sort ASC")->queryAll();
foreach ($array_menu_main as $val_menu_main){


?>
<li>
<a href="javascript:void(0)" class="has-arrow arrow-c"><i class="<?=$val_menu_main['m_icon'];?>"></i><span><?=$val_menu_main['m_name'];?></span></a>
<ul>
    <?php  $array_menu_sub = Yii::$app->db->createCommand("SELECT * FROM `menu_sub` WHERE submenu_active = 'Y' AND menu_id = '".$val_menu_main['id']."' ORDER BY submenu_sort ASC")->queryAll();
    foreach ($array_menu_sub as $val_menu_sub){
        ?>
        <li><a href="index.html"><span><?=$val_menu_sub['submenu_name'];?></span></a></li>
    <?php } ?>
</ul>
</li>

<?php } ?> -->
<?php if(!empty($menu_main_role)):
    $array_menu_main = Yii::$app->db->createCommand("SELECT * FROM `menu_main` WHERE m_status = 'Y' $where_main_id ORDER BY m_sort ASC")->queryAll();
    foreach ($array_menu_main as $val_menu_main):
        if ($val_menu_main['m_active']=='1') {
          $class_active = 'active';
      }else{
          $class_active = '';
      }

      ?>


      <?php if($val_menu_main['m_link']!='' || strlen($val_menu_main['m_link'])>1): ?>
        <li><a href="<?=$val_menu_main['m_link']?>"><i class="<?=$val_menu_main['m_icon'];?>"></i><span><?=$val_menu_main['m_name'];?></span></a></li>
        <?php else: ?>

          <?php if($val_menu_main['id']=='1'): ?>
              <!-- <h3 class="menu-title">จัดการระบบ</h3> -->
          <?php endif; ?>
          <?php
          $server = $_SERVER['REQUEST_URI'];
          $server = str_replace("/textx/textx/frontend/web/",'',$server);
          $activeMenu = Yii::$app->db->createCommand("SELECT * FROM `menu_sub`,`menu_main` WHERE menu_sub.menu_id = menu_main.id AND menu_sub.submenu_link = '".$server."'")->queryOne();

          if ($server == $activeMenu['submenu_link']) {
            $act = "active";
            // echo $activeMenu['id'];
          }
          ?>
          <li class="<?php if($val_menu_main['id'] == $activeMenu['id']){echo 'active'; }else { echo ''; } ?>">
            <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="<?=$val_menu_main['m_icon'];?>"></i><span><?=$val_menu_main['m_name'];?></span></a>
            <ul>
                <?php  $array_menu_sub = Yii::$app->db->createCommand("SELECT * FROM `menu_sub` WHERE submenu_active = 'Y' AND menu_id = '".$val_menu_main['id']."' ORDER BY submenu_sort ASC")->queryAll();
                foreach ($array_menu_sub as $val_menu_sub){
                    ?>  
                    <li class="<?php if($val_menu_sub['submenu_id'] == $activeMenu['submenu_id']){echo 'active-sub'; }else { echo ''; } ?>">
                        <a href="<?=$val_menu_sub['submenu_link'];?>">
                            <span><?=$val_menu_sub['submenu_name'];?></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>

<!-- <li>
    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-rocket"></i><span>HRMS</span></a>
    <ul>

        <li class="active"><a href="index.html"><span>Dashboard</span></a></li>
        <li><a href="hr-users.html"><span>Users</span></a></li>
        <li><a href="hr-departments.html"><span>Departments</span></a></li>
        <li><a href="hr-employee.html"><span>Employee</span></a></li>
        <li><a href="hr-activities.html"><span>Activities</span></a></li>
        <li><a href="hr-holidays.html"><span>Holidays</span></a></li>
        <li><a href="hr-events.html"><span>Events</span></a></li>
        <li><a href="hr-payroll.html"><span>Payroll</span></a></li>
        <li><a href="hr-accounts.html"><span>Accounts</span></a></li>
        <li><a href="hr-report.html"><span>Report</span></a></li>
    </ul>
</li> 
<li>
    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-cup"></i><span>Project</span></a>
    <ul>
        <li><a href="project-index.html">Dashboard</a></li>                        
        <li><a href="project-list.html">Project list</a></li>
        <li><a href="project-taskboard.html">Taskboard</a></li>
        <li><a href="project-ticket.html">Ticket List</a></li>
        <li><a href="project-ticket-details.html">Ticket Details</a></li>
        <li><a href="project-clients.html">Clients</a></li>
        <li><a href="project-todo.html">Todo List</a></li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-briefcase"></i><span>Job Portal</span></a>
    <ul>
        <li><a href="job-index.html"><span>Job Dashboard</span></a></li>
        <li><a href="job-positions.html"><span>Positions</span></a></li>                    
        <li><a href="job-applicants.html"><span>Applicants</span></a></li>
        <li><a href="job-resumes.html"><span>Resumes</span></a></li>
        <li><a href="job-settings.html"><span>Settings</span></a></li>
    </ul>
</li>
<li>
    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-lock"></i><span>Authentication</span></a>
    <ul>
        <li><a href="login.html">Login</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="forgot-password.html">Forgot password</a></li>
        <li><a href="404.html">404 error</a></li>
        <li><a href="500.html">500 error</a></li>   
    </ul>
</li> -->
<!-- <li class="g_heading">UI Elements</li>
<li>
    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="icon-lock"></i><span>Layouts</span></a>
    <ul>
        <li><a href="../layouts/layout-menu.html">Menu with Tab</a></li>
        <li><a href="../layouts/layout-menu-dark.html">Dark Menu</a></li>
        <li><a href="../layouts/layout-menu-grid.html">Menu with Grid</a></li>
        <li><a href="../layouts/layout-menu-mini-dark.html">Mini Dark Menu</a></li>
        <li><a href="../layouts/layout-menu-collapse.html">Menu Collapse</a></li>
        <li><a href="../layouts/layout-menu-rtl.html">RTL Version</a></li>
        <li><a href="../layouts/layout-menu-rtl-collapse.html">RTL Menu Collapse</a></li>
        <li><a href="../layouts/layout-page-hedaer-drak.html">Header Dark</a></li>
        <li><a href="../layouts/layout-page-hedaer-fix.html">Header Top Fix</a></li>
        <li><a href="../layouts/layout-dark.html">Full Dark</a></li>
        <li><a href="../layouts/layout-dark-sidebar-color.html">Dark Sidebar Color</a></li>
    </ul>
</li>
<li><a href="icons-fontawesome.html"><i class="icon-tag"></i><span>Icons</span></a></li>
<li><a href="charts-apex.html"><i class="icon-bar-chart"></i><span>Charts</span></a></li>
<li><a href="form-elements.html"><i class="icon-layers"></i><span>Forms</span></a></li>
<li><a href="table-normal.html"><i class="icon-tag"></i><span>Tables</span></a></li>                
<li><a href="widgets.html"><i class="icon-puzzle"></i><span>Widgets</span></a></li>                
<li><a href="page-maps.html"><i class="icon-map"></i><span>Maps</span></a></li>
<li><a href="page-gallery.html"><i class="icon-picture"></i><span>Gallery</span></a></li> 
<li><a href="index.php?r=site/logout_clear"> <i class="fa fa-power-off"></i><span>ออกจากระบบ </span></a></li>-->
</ul>
</nav>        
</div>

<div class="page">
    <div id="page_top" class="section-body ">
        <div class="container-fluid">
            <div class="page-header">
                <div class="left">
                    <h1 class="page-title">HR Dashboard</h1>
                    <select class="custom-select">
                        <option>Year</option>
                        <option>Month</option>
                        <option>Week</option>
                    </select>
                    <div class="input-group xs-hide">
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>              
                </div>
                <div class="right">
                    <ul class="nav nav-pills">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ภาษา</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../../html-version/assets/images/flags/us.svg">English</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../../html-version/assets/images/flags/th.svg">Thai</a>
        <!-- <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../../html-version/assets/images/flags/jp.svg">japanese</a>
            <a class="dropdown-item" href="#"><img class="w20 mr-2" src="../../html-version/assets/images/flags/bl.svg">France</a> -->
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">รายงาน</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="dropdown-icon fa fa-file-excel-o"></i> MS Excel</a>
            <a class="dropdown-item" href="#"><i class="dropdown-icon fa fa-file-word-o"></i> MS Word</a>
            <a class="dropdown-item" href="#"><i class="dropdown-icon fa fa-file-pdf-o"></i> PDF</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">โครงการ</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Graphics Design</a>                                    
            <a class="dropdown-item" href="#">Angular Admin</a>
            <a class="dropdown-item" href="#">PSD to HTML</a>
            <a class="dropdown-item" href="#">iOs App Development</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Home Development</a>
            <a class="dropdown-item" href="#">New Blog post</a>
        </div>
    </li>
</ul>
<div class="notification d-flex">
    <div class="dropdown d-flex">
        <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success nav-unread"></span></a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <ul class="right_chat list-unstyled w250 p-0">
                <li class="online">
                    <a href="javascript:void(0);">
                        <div class="media">
                            <img class="media-object " src="../../html-version/assets/images/xs/avatar4.jpg" alt="">
                            <div class="media-body">
                                <span class="name">Donald Gardner</span>
                                <span class="message">Designer, Blogger</span>
                                <span class="badge badge-outline status"></span>
                            </div>
                        </div>
                    </a>                            
                </li>
                <li class="online">
                    <a href="javascript:void(0);">
                        <div class="media">
                            <img class="media-object " src="../../html-version/assets/images/xs/avatar5.jpg" alt="">
                            <div class="media-body">
                                <span class="name">Wendy Keen</span>
                                <span class="message">Java Developer</span>
                                <span class="badge badge-outline status"></span>
                            </div>
                        </div>
                    </a>                            
                </li>
                <li class="offline">
                    <a href="javascript:void(0);">
                        <div class="media">
                            <img class="media-object " src="../../html-version/assets/images/xs/avatar2.jpg" alt="">
                            <div class="media-body">
                                <span class="name">Matt Rosales</span>
                                <span class="message">CEO, Epic Theme</span>
                                <span class="badge badge-outline status"></span>
                            </div>
                        </div>
                    </a>                            
                </li>
                <li class="online">
                    <a href="javascript:void(0);">
                        <div class="media">
                            <img class="media-object " src="../../html-version/assets/images/xs/avatar3.jpg" alt="">
                            <div class="media-body">
                                <span class="name">Phillip Smith</span>
                                <span class="message">Writter, Mag Editor</span>
                                <span class="badge badge-outline status"></span>
                            </div>
                        </div>
                    </a>                            
                </li>                        
            </ul>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
        </div>
    </div>
    <div class="dropdown d-flex">
        <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-primary nav-unread"></span></a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <ul class="list-unstyled feeds_widget">
                <li>
                    <div class="feeds-left"><i class="fa fa-check"></i></div>
                    <div class="feeds-body">
                        <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted">11:05</small></h4>
                        <small>WE have fix all Design bug with Responsive</small>
                    </div>
                </li>
                <li>
                    <div class="feeds-left"><i class="fa fa-user"></i></div>
                    <div class="feeds-body">
                        <h4 class="title">New User <small class="float-right text-muted">10:45</small></h4>
                        <small>I feel great! Thanks team</small>
                    </div>
                </li>
                <li>
                    <div class="feeds-left"><i class="fa fa-thumbs-o-up"></i></div>
                    <div class="feeds-body">
                        <h4 class="title">7 New Feedback <small class="float-right text-muted">Today</small></h4>
                        <small>It will give a smart finishing to your site</small>
                    </div>
                </li>
                <li>
                    <div class="feeds-left"><i class="fa fa-question-circle"></i></div>
                    <div class="feeds-body">
                        <h4 class="title text-warning">Server Warning <small class="float-right text-muted">10:50</small></h4>
                        <small>Your connection is not private</small>
                    </div>
                </li>
                <li>
                    <div class="feeds-left"><i class="fa fa-shopping-cart"></i></div>
                    <div class="feeds-body">
                        <h4 class="title">7 New Orders <small class="float-right text-muted">11:35</small></h4>
                        <small>You received a new oder from Tina.</small>
                    </div>
                </li>                                   
            </ul>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
        </div>
    </div>
    <div class="dropdown d-flex">
        <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-1" data-toggle="dropdown"><i class="fa fa-user"></i></a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
            <a class="dropdown-item" href="index.php?r=users/update&id=<?php echo $_SESSION['user_id'];?>
            "><i class="dropdown-icon fe fe-user"></i> ข้อมูลส่วนตัว</a>
            <a class="dropdown-item" href="index.php?r=users/change_password&id=<?php echo $_SESSION['user_id'];?>"><i class="dropdown-icon fe fe-unlock"></i> เปลี่ยนรหัสผ่าน</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="index.php?r=user-role"><i class="dropdown-icon fe fe-sliders"></i> จัดการสิทธิ์การเข้าใช้งาน</a>
            <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i> ตั้งค่าการใช้งาน</a>
            <a class="dropdown-item" href="index.php?r=site/pages&view=stat_users"><i class="dropdown-icon fe fe-users"></i> สถิตการเข้าใช้งาน</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:void(0)"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-send"></i> Message</a>
            <a class="dropdown-item" href="index.php?r=site/pages&view=questionAndAnswer"><i class="dropdown-icon fe fe-file"></i> Q&A</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-help-circle"></i> ต้องการความช่วยเหลือ?</a>
            <a class="dropdown-item" href="index.php?r=site/logout_clear"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<div class="section-body mt-3">
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>    
<div class="section-body">
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    Copyright © 2019 <a href="http://www.pd-it-solution.com/">PD IT SOLUTION</a>.
                </div>
                <div class="col-md-6 col-sm-12 text-md-right">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../doc/index.html">Documentation</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">FAQ</a></li>
                        <!--  <li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-outline-primary btn-sm">Buy Now</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>    
</div>


<script src="../../html-version/assets/bundles/lib.vendor.bundle.js"></script>

<script src="../../html-version/assets/bundles/apexcharts.bundle.js"></script>
<script src="../../html-version/assets/bundles/echarts.bundle.js"></script>
<script src="../../html-version/assets/bundles/counterup.bundle.js"></script>
<script src="../../html-version/assets/bundles/knobjs.bundle.js"></script>
<script src="../../html-version/assets/bundles/c3.bundle.js"></script>
<script src="../../html-version/assets/bundles/summernote.bundle.js"></script>
<script src="../../html-version/assets/js/core.js"></script>
<script src="../../html-version/assets/plugins/dropify/js/dropify.min.js"></script>

<script src="../../html-version/main/assets/js/page/index.js"></script>
<script src="../../html-version/main/assets/js/form/form-advanced.js"></script>
<script src="../../html-version/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="../../html-version/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../../html-version/assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="../../html-version/assets/plugins/multi-select/js/jquery.multi-select.js"></script>
<script src="../../html-version/assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="../../html-version/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

<?php $this->endBody() ?>
</body>
</html>

<script>
    $.noConflict();
</script>
<?php
// $this->registerJsFile('../../html-version/assets/bundles/lib.vendor.bundle.js');
?>

<?php $this->endPage() ?>
