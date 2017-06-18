@extends('layouts.main')
@section('content')
	
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
		

			<div class="list">
				<div class="row">
					<div class="col l10">
						
					</div>
					<div class=" col l1 visualization_setting_section">
						<span><i class="btn btn-primary fa fa-filter" style="font-size: 30px;line-height: 36px;"></i></span>
						<div class="setting-div">
							<div class="header">
								<h5>Filters</h5>
							</div>
							<div class="divider"></div>
							<div class="settings">
								<div class="row pv-10">
									<div class="col l5" style="line-height: 30px">
										Select theme
									</div>
									<div class="col l7">
										<select>
											<option value="1" selected="selected">Minimal</option>
											<option value="2">Clear light</option>
											<option value="3">Clear Dark</option>
									    </select>
									</div>
								</div>
								<div class="row pv-10">
									<div class="col l5" style="line-height: 22px">
										Enable Header
									</div>
									<div class="col l7">
										<div class="row">
											<div class="col l3" style="float: right;">
												<div class="switch">
												    <label>
												      <input type="checkbox">
												      <span class="lever"></span>
												    </label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row pv-10">
									<div class="col l5" style="line-height: 22px">
										Enable Footer
									</div>
									<div class="col l7">
										<div class="row">
											<div class="col l3" style="float: right;">
												<div class="switch">
												    <label>
												      <input type="checkbox">
												      <span class="lever"></span>
												    </label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row pv-10">
									<div class="col l5" style="line-height: 22px">
										Enable Copyright
									</div>
									<div class="col l7">
										<div class="row">
											<div class="col l3" style="float: right;">
												<div class="switch">
												    <label>
												      <input type="checkbox">
												      <span class="lever"></span>
												    </label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class=" col l1 visualization_setting_section">
						<span><i class="btn btn-primary fa fa-cog" style="font-size: 30px;line-height: 36px;"></i></span>
						<div class="setting-div">
							<div class="header">
								<h5>Visualization Settings</h5>
							</div>
							<div class="divider"></div>
							<div class="settings">
								<div class="row pv-10">
									<div class="col l5" style="line-height: 30px">
										Select theme
									</div>
									<div class="col l7">
										<select>
											<option value="1" selected="selected">Minimal</option>
											<option value="2">Clear light</option>
											<option value="3">Clear Dark</option>
									    </select>
									</div>
								</div>
								<div class="row pv-10">
									<div class="col l5" style="line-height: 22px">
										Enable Header
									</div>
									<div class="col l7">
										<div class="row">
											<div class="col l3" style="float: right;">
												<div class="switch">
												    <label>
												      <input type="checkbox">
												      <span class="lever"></span>
												    </label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row pv-10">
									<div class="col l5" style="line-height: 22px">
										Enable Footer
									</div>
									<div class="col l7">
										<div class="row">
											<div class="col l3" style="float: right;">
												<div class="switch">
												    <label>
												      <input type="checkbox">
												      <span class="lever"></span>
												    </label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row pv-10">
									<div class="col l5" style="line-height: 22px">
										Enable Copyright
									</div>
									<div class="col l7">
										<div class="row">
											<div class="col l3" style="float: right;">
												<div class="switch">
												    <label>
												      <input type="checkbox">
												      <span class="lever"></span>
												    </label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>			
				<div class="card-panel shadow white z-depth-1 hoverable project" data-site="name">

				</div>
			</div>
		</div>

	</div>
</div>

<style type="text/css">
	.setting-div{
		display: none;
		position: absolute;
		width: 300px;
		right: 22px;
		background-color: #fff;
		border:1px solid #e8e8e8;
		padding: 10px 17px 10px 8px;
		box-shadow: 2px 3px 12px #e8e8e8;
	}
</style>
<script type="text/javascript">
	$('.visualization_setting_section .fa-cog').click(function(){
		$('.setting-div').toggle();
	});
</script>
@endsection



