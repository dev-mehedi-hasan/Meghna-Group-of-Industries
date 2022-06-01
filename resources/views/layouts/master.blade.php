
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
  <title>Ticketing Module - @yield('title')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.2/themes/mint-choc/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="{{ asset('/asset/css/style.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-footer-fixed layout-navbar-fixed layout-fixed">
    <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <div id="app">
      <div class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white">
          <ul class="navbar-nav d-lg-none">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="bottom" title="Logout">
                  <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-widget="control-sidebar" data-slide="true" role="button">
                  <span><i class="fas fa-sign-out-alt fa-lg"></i></span> Sign Out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </span>
            </li>
          </ul>
        </nav>

        <aside class="main-sidebar">
          <a href="" class="brand-link bg-white d-flex justify-content-center align-items-center">
            <img src="{{ asset('/img/logo.png') }}" alt="MGI" class="brand-image">
          </a>
          <div class="sidebar bg-light">
            <div class="user-panel d-flex flex-column border-bottom-3 border-primary rounded">
                <div class="image d-flex justify-content-center">
                  <img src="{{ asset('/img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info d-flex justify-content-center text-center">
                  <div class="row">
                      <div class="col-12">
                          @php if(isset(Auth::user()->name)){
                          @endphp
                              <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                          @php
                          }
                          @endphp
                      </div>
                      <div class="col-12">
                          <div class="role">
                              @if (Auth::user()->isAdmin)
                                  <span href="#" class="d-block">Role: Admin</span>
                              @else
                                  <span href="#" class="d-block">Role: Supervisor</span>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <nav class="mt-2">
              <ul class="nav tabs nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="{{ route('home') }}" class="nav-link {{ '/' == \Request::path() ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                    @php
                      $currentURL= "";
                      $currentPath = \Request::path();
                      if(isset($_SERVER['QUERY_STRING'])){
                        $queryString = $_SERVER['QUERY_STRING'];
                        $currentURL = $currentPath.'?'.$queryString;
                      }
                    @endphp
                <li class="nav-item has-treeview menu-open {{ ('ticket?ticket_type=new' == $currentURL) || ('ticket?ticket_type=wip' == $currentURL) || ('ticket?ticket_type=answered' == $currentURL) || ('ticket?ticket_type=closed' == $currentURL) || ('ticket/downloadPanel' == $currentPath) || ('ticket' == \Request::segment(1)) ?  'menu-open' : '' }}">
                  <a href="#" class="nav-link bg-white {{ ('ticket?ticket_type=new' == $currentURL) || ('ticket?ticket_type=wip' == $currentURL) || ('ticket?ticket_type=answered' == $currentURL) || ('ticket?ticket_type=closed' == $currentURL) || ('ticket/downloadPanel' == $currentPath) || ('ticket' == \Request::segment(1)) ?  'active' : '' }}">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>
                      Ticket Panel
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('ticket', ['ticket_type' => 'new']) }}" class="nav-link {{ ('ticket?ticket_type=new' == $currentURL) ? 'active' : '' }}">
                        <i class="fa fa-calendar-plus nav-icon"></i>
                        <p>
                          New Ticket
                          <span class="right badge badge-success">New</span>
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('ticket', ['ticket_type' => 'wip']) }}" class="nav-link {{ 'ticket?ticket_type=wip' == $currentURL ? 'active' : '' }}">
                        <i class="fa fa-spinner nav-icon"></i>
                        <p>
                          WIP Ticket
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('ticket', ['ticket_type' => 'answered']) }}" class="nav-link {{ 'ticket?ticket_type=answered' == $currentURL ? 'active' : '' }}">
                        <i class="fa fa-reply nav-icon"></i>
                        <p>
                          Answered Ticket
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('ticket', ['ticket_type' => 'closed']) }}" class="nav-link {{ 'ticket?ticket_type=closed' == $currentURL ? 'active' : '' }}">
                        <i class="fa fa-times nav-icon"></i>
                        <p>
                          Closed Ticket
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('ticket.downloadPanel') }}" class="nav-link {{ 'ticket/downloadPanel' ==  $currentPath ? 'active' : '' }}">
                        <i class="fas fa-clipboard nav-icon"></i>
                        <p>
                          Report Download
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
                @if(Auth::user()->isAdmin)
                <li class="nav-item has-treeview menu-open {{ ('department' == \Request::segment(1)) || ('division' == \Request::segment(1)) || ('district' == \Request::segment(1)) || ('query-type' == \Request::segment(1)) || ('complain-type' == \Request::segment(1)) || ('call-remarks' == \Request::segment(1)) ?  'menu-open' : '' }}">
                  <a href="#" class="nav-link bg-white {{ ('department' == \Request::segment(1)) || ('division' == \Request::segment(1)) || ('district' == \Request::segment(1)) || ('query-type' == \Request::segment(1)) || ('complain-type' == \Request::segment(1)) || ('call-remarks' == \Request::segment(1)) ?  'active' : '' }}">
                    <i class="nav-icon fas fa-braille"></i>
                    <p>
                      Static Content
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('department.index') }}" class="nav-link {{ 'department' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fa fa-building nav-icon"></i>
                        <p>
                          Departments
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('division.index') }}" class="nav-link {{ 'division' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fas fa-globe-asia nav-icon"></i>
                        <p>
                          Divisions
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('district.index') }}" class="nav-link {{ 'district' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fas fa-map-marked-alt nav-icon"></i>
                        <p>
                          Districts
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('query-type.index') }}" class="nav-link {{ 'query-type' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fa fa-question-circle nav-icon"></i>
                        <p>
                          Query Type
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('complain-type.index') }}" class="nav-link {{ 'complain-type' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fa fa-exclamation-triangle nav-icon"></i>
                        <p>
                          Complain Type
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('call-remarks.index') }}" class="nav-link {{ 'call-remarks' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fas fa-comment-dots nav-icon"></i>
                        <p>
                          Call Remarks
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview menu-open {{ ('assign-tickets' == \Request::segment(1)) || ('escalation-levels' == \Request::segment(1)) || ('escalation-matrix' == \Request::segment(1)) || ('common-mail-cc' == \Request::segment(1)) ?  'menu-open' : '' }}">
                  <a href="#" class="nav-link bg-white {{ ('assign-tickets' == \Request::segment(1)) || ('escalation-levels' == \Request::segment(1)) || ('escalation-matrix' == \Request::segment(1)) || ('common-mail-cc' == \Request::segment(1)) ?  'active' : '' }}">
                    <i class="nav-icon fas fa-border-inner"></i>
                    <p>
                      Ticketing Matrix
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('assign-tickets.index') }}" class="nav-link {{ 'assign-tickets' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fas fa-people-carry nav-icon"></i>
                        <p>
                          Assign Ticket Persons
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('escalation-levels.index') }}" class="nav-link {{ 'escalation-levels' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fas fa-shoe-prints nav-icon"></i>
                        <p>
                          Escalation Levels
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('escalation-matrix.index') }}" class="nav-link {{ 'escalation-matrix' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fas fa-sitemap nav-icon"></i>
                        <p>
                          Ticket Escallation
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('common-mail-cc.index') }}" class="nav-link {{ 'common-mail-cc' == \Request::segment(1) ? 'active' : '' }}">
                        <i class="fab fa-creative-commons nav-icon"></i>
                        <p>
                          Common Mail CC
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
                @endif
                <li class="nav-item has-treeview menu-open {{ ('crm' == $currentPath) || ('crm/downloadPanel' == $currentPath) ?  'menu-open' : '' }}">
                  <a href="#" class="nav-link bg-white {{ ('crm' == $currentPath) || ('crm/downloadPanel' == $currentPath) ?  'active' : '' }}">
                    <i class="nav-icon fas fa-chart-line"></i>
                    <p>
                      Crm Panel
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="{{ route('crm') }}" class="nav-link {{ 'crm' == $currentPath ? 'active' : '' }}">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>
                          Crm List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="{{ route('crm.downloadPanel') }}" class="nav-link {{ 'crm/downloadPanel' == $currentPath ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                          Report Download
                        </p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item mt-5">
                  <a href="{{url('http://202.51.177.156/mgi-ticket/api/crm-create?phone_number=01792095970&agent=Mehedi')}}" target="_blank" class="nav-link bg-white text-success">
                    <i class="nav-icon fas fa-globe"></i>
                    <p>
                      Browse Website
                      <i class="right fas fa-external-link-alt"></i>
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </aside>

        <div class="content-wrapper">
          <main class="content">
                  @yield('content')
          </main>
        </div>

      </div>
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy <a href="https://myolbd.com">MY Outsourcing Ltd.</a>.</strong> All rights reserved.
    </footer>

<!-- ./wrapper -->
    {{-- @include('sweetalert::alert') --}}
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.3/TweenMax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/MorphSVGPlugin.min.js"></script>
    <script src="{{ asset('/asset/js/active.js') }}"></script>
    <script src="{{ asset('/js/Chart.js') }}"></script>
    @yield('scripts')

</body>
</html>
