<div class="site-sidebar">
	<div class="custom-scroll custom-scroll-light">
		<ul class="sidebar-menu">
			<li class="menu-title">@lang('admin.include.admin_dashboard')</li>
			<li>
				<a href="{{ route('admin.dashboard') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-dashboard"></i></span>
					<span class="s-text">@lang('admin.include.dashboard')</span>
				</a>
			</li>
{{--			<li>--}}
{{--				<a href="{{ route('admin.dispatcher.index') }}" class="waves-effect waves-light">--}}
{{--					<span class="s-icon"><i class="ti-headphone-alt"></i></span>--}}
{{--					<span class="s-text">@lang('admin.include.dispatcher_panel')</span>--}}
{{--				</a>--}}
{{--			</li>--}}
			
			<li>
				<a href="{{ route('admin.heatmap') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-map"></i></span>
					<span class="s-text">@lang('admin.include.heat_map')</span>
				</a>
			</li>
			
			<li class="menu-title">@lang('admin.include.members')</li>
			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-hand-open"></i></span>
					<span class="s-text">@lang('admin.include.users')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.user.index') }}">@lang('admin.include.list_users')</a></li>
{{--					<li><a href="{{ route('admin.user.create') }}">@lang('admin.include.add_new_user')</a></li>--}}
				</ul>
			</li>
			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-car"></i></span>
					<span class="s-text">@lang('admin.include.drivers')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.driver.index') }}">@lang('admin.include.list_drivers')</a></li>
{{--					<li><a href="{{ route('admin.driver.create') }}">@lang('admin.include.add_new_provider')</a></li>--}}
				</ul>
			</li>
{{--			<li class="with-sub">--}}
{{--				<a href="#" class="waves-effect  waves-light">--}}
{{--					<span class="s-caret"><i class="fa fa-angle-down"></i></span>--}}
{{--					<span class="s-icon"><i class="ti-headphone-alt"></i></span>--}}
{{--					<span class="s-text">@lang('admin.include.dispatcher')</span>--}}
{{--				</a>--}}
{{--				<ul>--}}
{{--					<li><a href="{{ route('admin.dispatch-manager.index') }}">@lang('admin.include.list_dispatcher')</a></li>--}}
{{--					<li><a href="{{ route('admin.dispatch-manager.create') }}">@lang('admin.include.add_new_dispatcher')</a></li>--}}
{{--				</ul>--}}
{{--			</li>--}}
{{--			<li class="with-sub">--}}
{{--				<a href="#" class="waves-effect  waves-light">--}}
{{--					<span class="s-caret"><i class="fa fa-angle-down"></i></span>--}}
{{--					<span class="s-icon"><i class="ti-car"></i></span>--}}
{{--					<span class="s-text">@lang('admin.include.fleet_owner')</span>--}}
{{--				</a>--}}
{{--				<ul>--}}
{{--					<li><a href="{{ route('admin.fleet.index') }}">@lang('admin.include.list_fleets')</a></li>--}}
{{--					<li><a href="{{ route('admin.fleet.create') }}">@lang('admin.include.add_new_fleet_owner')</a></li>--}}
{{--				</ul>--}}
{{--			</li>--}}
{{--			<li class="with-sub">--}}
{{--				<a href="#" class="waves-effect  waves-light">--}}
{{--					<span class="s-caret"><i class="fa fa-angle-down"></i></span>--}}
{{--					<span class="s-icon"><i class="ti-eye"></i></span>--}}
{{--					<span class="s-text">@lang('admin.include.account_manager')</span>--}}
{{--				</a>--}}
{{--				<ul>--}}
{{--					<li><a href="{{ route('admin.account-manager.index') }}">@lang('admin.include.list_account_managers')</a></li>--}}
{{--					<li><a href="{{ route('admin.account-manager.create') }}">@lang('admin.include.add_new_account_manager')</a></li>--}}
{{--				</ul>--}}
{{--			</li>--}}
			<li class="menu-title">@lang('admin.include.accounts')</li>
			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-money"></i></span>
					<span class="s-text">@lang('admin.include.statements')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.ride.statement') }}">@lang('admin.include.overall_ride_statments')</a></li>
					<li><a href="{{ route('admin.ride.statement.driver') }}">@lang('admin.include.provider_statement')</a></li>
					<li><a href="{{ route('admin.ride.statement.today') }}">@lang('admin.include.daily_statement')</a></li>
					<li><a href="{{ route('admin.ride.statement.monthly') }}">@lang('admin.include.monthly_statement')</a></li>
					<li><a href="{{ route('admin.ride.statement.yearly') }}">@lang('admin.include.yearly_statement')</a></li>
				</ul>
			</li>
			<li class="menu-title">@lang('admin.include.details')</li>
			<li>
				<a href="{{ route('admin.map.index') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-map-alt"></i></span>
					<span class="s-text">@lang('admin.include.map')</span>
				</a>
			</li>
{{--			<li class="with-sub">--}}
{{--				<a href="#" class="waves-effect  waves-light">--}}
{{--					<span class="s-caret"><i class="fa fa-angle-down"></i></span>--}}
{{--					<span class="s-icon"><i class="ti-comments-smiley"></i></span>--}}
{{--					<span class="s-text">@lang('admin.include.ratings') &amp; @lang('admin.include.reviews')</span>--}}
{{--				</a>--}}
{{--				<ul>--}}
{{--					<li><a href="{{ route('admin.user.review') }}">@lang('admin.include.user_ratings')</a></li>--}}
{{--					<li><a href="{{ route('admin.driver.review') }}">@lang('admin.include.provider_ratings')</a></li>--}}
{{--				</ul>--}}
{{--			</li>--}}

			<li class="with-sub">
				<a href="#" class="waves-effect waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-location-arrow"></i></span>
					<span class="s-text">@lang('admin.include.places')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.places.index') }}">@lang('admin.include.places_list')</a></li>
					<li><a href="{{ route('admin.places.create') }}">@lang('admin.include.create_place')</a></li>
				</ul>
			</li>
			<li class="menu-title">@lang('admin.include.requests')</li>
			<li>
				<a href="{{ route('admin.rides.index') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-archive"></i></span>
					<span class="s-text">@lang('admin.include.request_history')</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.rides.scheduled') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-calendar"></i></span>
					<span class="s-text">@lang('admin.include.scheduled_rides')</span>
				</a>
			</li>
			<li class="menu-title">@lang('admin.include.general')</li>
			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-car"></i></span>
					<span class="s-text">@lang('admin.include.service_types')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.service.index') }}">@lang('admin.include.list_service_types')</a></li>
					<li><a href="{{ route('admin.service.create') }}">@lang('admin.include.add_new_service_type')</a></li>
				</ul>
			</li>
			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-layout-tab"></i></span>
					<span class="s-text">@lang('admin.include.documents')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.document.index') }}">@lang('admin.include.list_documents')</a></li>
					<li><a href="{{ route('admin.document.create') }}">@lang('admin.include.add_new_document')</a></li>
				</ul>
			</li>

			<li class="with-sub">
				<a href="#" class="waves-effect  waves-light">
					<span class="s-caret"><i class="fa fa-angle-down"></i></span>
					<span class="s-icon"><i class="ti-gift"></i></span>
					<span class="s-text">@lang('admin.include.coupons')</span>
				</a>
				<ul>
					<li><a href="{{ route('admin.coupon.index') }}">@lang('admin.include.list_coupons')</a></li>
					<li><a href="{{ route('admin.coupon.create') }}">
					@lang('admin.include.add_new_coupon')</a></li>
				</ul>
			</li>
			
			<li class="menu-title">@lang('admin.include.payment_details')</li>
			<li>
				<a href="{{ route('admin.payment') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-credit-card"></i></span>
					<span class="s-text">@lang('admin.include.payment_history')</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.settings.payment') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-wallet"></i></span>
					<span class="s-text">@lang('admin.include.payment_settings')</span>
				</a>
			</li>
			<li class="menu-title">@lang('admin.include.settings')</li>
			<li>
				<a href="{{ route('admin.settings') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-settings"></i></span>
					<span class="s-text">@lang('admin.include.site_settings')</span>
				</a>
			</li>
			
			<li class="menu-title">@lang('admin.include.others')</li>
			<li>
				<a href="{{ route('admin.privacy') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-lock"></i></span>
					<span class="s-text">@lang('admin.include.privacy_policy')</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.help') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-info-alt"></i></span>
					<span class="s-text">@lang('admin.include.help')</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.push') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-announcement"></i></span>
					<span class="s-text">@lang('admin.include.custom_push')</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.translation') }}" class="waves-effect waves-light">
					<span class="s-icon"><i class="ti-smallcap"></i></span>
					<span class="s-text">@lang('admin.include.translations')</span>
				</a>
			</li>
			<li class="menu-title">@lang('admin.include.account')</li>
			<li>
				<a href="{{ route('admin.profile') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-user"></i></span>
					<span class="s-text">@lang('admin.include.account_settings')</span>
				</a>
			</li>
			<li>
				<a href="{{ route('admin.password') }}" class="waves-effect  waves-light">
					<span class="s-icon"><i class="ti-exchange-vertical"></i></span>
					<span class="s-text">@lang('admin.include.change_password')</span>
				</a>
			</li>
			<li class="compact-hide">
				<a href="{{ url('/admin/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
					<span class="s-icon"><i class="ti-power-off"></i></span>
					<span class="s-text">@lang('admin.include.logout')</span>
                </a>

                <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
			</li>
			
		</ul>
	</div>
</div>