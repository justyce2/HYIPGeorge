  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.gs.menubuilder') }}">
      <i class="fas fa-compass"></i>
      <span>{{ __('Menu Builder') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.referral.index') }}">
      <i class="fas fa-cogs"></i>
      <span>{{ __('Referral') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manage_plan" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fab fa-telegram-plane"></i>
      <span>{{  __('Manage Plan') }}</span>
    </a>
    <div id="manage_plan" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.schedule.index') }}">{{ __('Schedule') }}</a>
        <a class="collapse-item" href="{{ route('admin.plans.index') }}">{{ __('All Plans') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-user"></i>
      <span>{{  __('Manage Customers') }}</span>
    </a>
    <div id="customer" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.user.index') }}">{{ __('User List') }}</a>
        <a class="collapse-item" href="{{route('admin.kyc.info','user')}}">{{ __('User KYC Info') }}</a>
        <a class="collapse-item" href="{{route('admin.manage.module')}}">{{ __('User KYC Modules') }}</a>
        <a class="collapse-item" href="{{ route('admin.user.bonus') }}">{{ __('Referral Bonus') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.invests.index') }}">
      <i class="fas fa-piggy-bank"></i>
      <span>{{ __('Invests') }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.transactions.index') }}">
      <i class="fas fa-chart-line"></i>
      <span>{{ __('Transactions') }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#withdraw" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fab fa-cc-mastercard"></i>
      <span>{{  __('Withdraws') }}</span>
    </a>
    <div id="withdraw" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.withdraw.index') }}">{{ __('Withdraw Request') }}</a>
        <a class="collapse-item" href="{{ route('admin-withdraw-method-index') }}">{{ __('Withdraw Method') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.deposits.index') }}">
      <i class="fas fa-piggy-bank"></i>
      <span>{{ __('Deposits') }}</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#requestmoney" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-donate"></i>
    <span>{{ __('Request Money') }}</span>
  </a>
    <div id="requestmoney" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.request.money') }}">{{ __('All Money Request') }}</a>
        <a class="collapse-item" href="{{ route('admin.request.setting.create') }}">{{ __('Money Request Setting') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>{{  __('Manage Blog') }}</span>
    </a>
    <div id="blog" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.cblog.index') }}">{{ __('Categories') }}</a>
        <a class="collapse-item" href="{{ route('admin.blog.index') }}">{{ __('Posts') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable1" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-cogs"></i>
      <span>{{  __('General Settings') }}</span>
    </a>
    <div id="collapseTable1" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.gs.logo') }}">{{ __('Logo') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.fav') }}">{{ __('Favicon') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.load') }}">{{ __('Loader') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.breadcumb') }}">{{ __('Breadcumb Banner') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.contents') }}">{{ __('Website Contents') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.footer') }}">{{ __('Footer') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.error.banner') }}">{{ __('Error Banner') }}</a>
        <a class="collapse-item" href="{{ route('admin.gs.maintenance') }}">{{ __('Website Maintenance') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.gs.holiday') }}">
      <i class="fas fa-stopwatch"></i>
      <span>{{ __('Holiday Setting') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#homepage" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-igloo"></i>
    <span>{{ __('Home Page Manage') }}</span>
  </a>
    <div id="homepage" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.ps.hero') }}">{{ __('Hero Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.ps.about') }}">{{ __('About Us Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.counter.index') }}">{{ __('About Us Counter') }}</a>
        <a class="collapse-item" href="{{ route('admin.partners.index') }}">{{ __('Partners') }}</a>
        <a class="collapse-item" href="{{ route('admin.ps.profit') }}">{{ __('Profit Calculate') }}</a>
        <a class="collapse-item" href="{{ route('admin.account.process.index') }}">{{ __('How To Start') }}</a>
        <a class="collapse-item" href="{{ route('admin.ps.referral') }}">{{ __('Referral Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.feature.index') }}">{{ __('Feature Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.teams.index') }}">{{ __('Team Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.review.index') }}">{{ __('Testimonial Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.brands.index') }}">{{ __('Brand') }}</a>
        <a class="collapse-item" href="{{ route('admin.ps.call') }}">{{ __('Call To Action Section') }}</a>
        <a class="collapse-item" href="{{ route('admin.ps.heading') }}">{{ __('Section Heading') }}</a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#email_settings" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fa fa-envelope"></i>
      <span>{{  __('Email Settings') }}</span>
    </a>
    <div id="email_settings" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.mail.index') }}">{{ __('Email Template') }}</a>
        <a class="collapse-item" href="{{ route('admin.mail.config') }}">{{ __('Email Configurations') }}</a>
        <a class="collapse-item" href="{{ route('admin.group.show') }}">{{ __('Group Email') }}</a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.user.message') }}">
      <i class="fas fa-vote-yea"></i>
      <span>{{ __('Messages') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment_gateways" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>{{  __('Payment Settings') }}</span>
    </a>
    <div id="payment_gateways" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.currency.index') }}">{{ __('Currencies') }}</a>
        <a class="collapse-item" href="{{ route('admin.payment.index') }}">{{  __('Payment Gateways')  }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.role.index') }}">
      <i class="fa fa-crop"></i>
      <span>{{ __('Manage Roles') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.staff.index') }}">
      <i class="fas fa-fw fa-users"></i>
      <span>{{ __('Manage Staff') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{route('admin.manage.kyc.user','user')}}">
      <i class="fas fa-child"></i>
      <span>{{ __('Manage KYC Form') }}</span></a>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#langs" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-language"></i>
      <span>{{  __('Language Manage') }}</span>
    </a>
    <div id="langs" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin.lang.index')}}">{{ __('Website Language') }}</a>
        <a class="collapse-item" href="{{route('admin.tlang.index')}}">{{ __('Admin Panel Language') }}</a>
      </div>
    </div>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.font.index') }}">
      <i class="fas fa-font"></i>
      <span>{{ __('Fonts') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-edit"></i>
      <span>{{  __('Menu Page Settings') }}</span>
    </a>
    <div id="menu" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('admin.ps.contact') }}">{{ __('Contact Us Page') }}</a>
        <a class="collapse-item" href="{{ route('admin.page.index') }}">{{ __('Other Pages') }}</a>
        <a class="collapse-item" href="{{ route('admin.ps.login') }}">{{ __('Login/Registration Page') }}</a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#seoTools" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-wrench"></i>
      <span>{{  __('SEO Tools') }}</span>
    </a>
    <div id="seoTools" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin.seotool.analytics')}}">{{ __('Google Analytics') }}</a>
        <a class="collapse-item" href="{{route('admin.seotool.keywords')}}">{{ __('Website Meta Keywords') }}</a>
        <a class="collapse-item" href="{{route('admin.social.links.index')}}">{{ __('Social Links') }}</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.sitemap.index') }}">
      <i class="fa fa-sitemap"></i>
      <span>{{ __('Sitemaps') }}</span></a>
  </li>


  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.cache.clear') }}">
      <i class="fas fa-sync"></i>
      <span>{{ __('Clear Cache') }}</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sactive" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-at"></i>
      <span>{{  __('System Activation') }}</span>
    </a>
    <div id="sactive" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('admin-activation-form')}}">{{ __('Activation') }}</a>
        <a class="collapse-item" href="{{route('admin-generate-backup')}}">{{ __('Generate Backup') }}</a>
      </div>
    </div>
  </li>


