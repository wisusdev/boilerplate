<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('setting.index') ? 'active' : ''}}" href="{{route('setting.index')}}">Setting</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('env.index') ? 'active' : ''}}" href="{{route('env.index')}}">Env</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('roles.index') ? 'active' : ''}}" href="{{route('roles.index')}}">Roles</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{ request()->routeIs('users.index') ? 'active' : ''}}" href="{{route('users.index')}}">Usuarios</a>
				</li>
			</ul>
		</div>
	</div>
</nav>