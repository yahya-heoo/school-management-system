<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('main_sidebar_trans.dashboard') }}</span>
                            </div>
                           
                            <div class="clearfix"></div>
                        </a>
                        
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_sidebar_trans.Menu')}} </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main_sidebar_trans.grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grades.index')}}">{{trans('main_sidebar_trans.gradesList')}}</a></li>
                           
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('main_sidebar_trans.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('classrooms.index')}}">{{trans('classrooms_trans.ListOfClasses')}}</a></li>
                          
                        </ul>
                    </li>
                    <!-- menu item todo-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#section-menu">
                            <i class="ti-menu-alt"></i>
                            <span class="right-nav-text">{{trans('main_sidebar_trans.sections')}}</span> 
                            <div class="pull-right"><i class="ti-plus"></i></div>
                        </a>
                        <ul id="section-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href= "{{route('sections.index')}}" >{{trans('main_sidebar_trans.sections_list')}}</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    <!-- menu item chat-->
                    <li>
                        <a   href="javascript:void(0);" data-toggle="collapse" data-target="#student">
                            <i class="ti-comments"></i><span class="right-nav-text">{{trans('main_sidebar_trans.students')}}</span>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                        </a>

                        <ul id="student" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a   href="javascript:void(0);" data-toggle="collapse" data-target="#student_managment">
                                <span class="right-nav-text">{{trans('students_trans.students_managment')}}</span>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                </a>
                                <ul id="student_managment" class="collapse" data-parent="#student">
                                    <li><a href="{{route('students.index')}}">{{trans('main_sidebar_trans.students_list')}}</a></li>
                                    <li> <a href="{{route('students.create')}}">{{trans('main_sidebar_trans.add_student')}}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a   href="javascript:void(0);" data-toggle="collapse" data-target="#promotion_managment">
                                <span class="right-nav-text">{{trans('students_trans.promotions_managment')}}</span>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                </a>
                                <ul id="promotion_managment" class="collapse" data-parent="#student">
                                    <li> <a href="{{route('promotions.index')}}">{{trans('students_trans.promotions_list')}}</a></li>
                                    <li> <a href="{{route('promotions.create')}}">{{trans('students_trans.add_promotion')}}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a   href="javascript:void(0);" data-toggle="collapse" data-target="#graduation_managment">
                                <span class="right-nav-text">{{trans('students_trans.graduations_managment')}}</span>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                </a>
                                <ul id="graduation_managment" class="collapse" data-parent="#student">
                                    <li><a href="{{route('graduations.index')}}">{{trans('students_trans.graduations_list')}}</a></li>
                                    <li> <a href="{{route('graduations.create')}}">{{trans('students_trans.add_graduation')}}</a></li>
                                </ul>
                            </li>
                            

                        </ul>
                    </li>
                    <!-- menu item mailbox-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#teacher"><i class="ti-email"></i><span class="right-nav-text">
                            {{trans('main_sidebar_trans.teachers')}}</span> 
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        </a>
                        <ul id="teacher" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teachers.index')}}">{{trans('main_sidebar_trans.teachers_list')}}</a></li>
                        </ul>
                        
                    </li>
                    <!-- menu item Charts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">{{trans('main_sidebar_trans.parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{url('add_parent')}}>{{trans('main_sidebar_trans.parents_list')}}</a></li>
                        </ul>
                    </li>

                    <!-- menu font icon-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">
                                {{trans('main_sidebar_trans.accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fees" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('fees.index')}}">{{trans('fees_trans.fees')}}</a> </li>
                            <li> <a href="{{route('invoices.index')}}">{{trans('invoices_trans.invoices')}}</a> </li>
                            <li> <a href="{{route('receipts.index')}}">{{trans('receipts_trans.receipts')}}</a> </li>
                            <li> <a href="{{route('refunds.index')}}">{{trans('refunds_trans.refunds')}}</a> </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">
                                {{trans('subjects_trans.subjects')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('subjects.index')}}">{{trans('subjects_trans.subjects')}}</a> </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">
                                {{trans('main_sidebar_trans.attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendance" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attendances.index')}}">{{trans('main_sidebar_trans.attendance')}}</a> </li>
                            
                        </ul>
                    </li>
                    
                    
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">
                                {{trans('quizzes_trans.quizzes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Form" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('quizzes.index')}}">{{trans('quizzes_trans.quizzes')}}</a> </li>
                            
                        </ul>
                    </li>
                    <!-- menu item table -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{trans('main_sidebar_trans.library')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('library-resources.index') }}">{{trans('library_trans.resources_list')}}</a></li>
                            
                        </ul>
                    </li>
                    <!-- menu item Custom pages-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">
                                {{trans('main_sidebar_trans.online_classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('online-classes.index') }}">{{trans('online_classes_trans.online_classes')}}</a> </li>
                            <li> <a href="{{ route('online-classes.create', ['integration' => 1] ) }}">{{trans('online_classes_trans.direct_zoom')}}</a> </li>
                            <li> <a href="{{ route('online-classes.create', ['integration' => 0] ) }}">{{trans('online_classes_trans.manual_zoom')}}</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="maps.html"><i class="ti-location-pin"></i><span class="right-nav-text">{{trans('main_sidebar_trans.users')}}</span>
                            <span class="badge badge-pill badge-success float-right mt-1">06</span></a>
                    </li>
                    <!-- menu item Authentication-->
                    <li>
                        <a href="{{route('settings.index')}}">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('main_sidebar_trans.settings')}}</span></div>
                            
                            <div class="clearfix"></div>
                        </a>
                        
                    </li>
                    <!-- menu item maps-->
                    
                    
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
