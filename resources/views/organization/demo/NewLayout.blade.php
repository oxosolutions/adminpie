@extends('layouts.main')
@section('content')
	<div id="aione_page_header" class="aione-page-header">
		<div class="row">
			<div class="aione-page-title-container"> 
				<h3 class="aione-page-title">Test Global Functions</h3>
				
				<div class="clear"></div>
			</div> <!-- .aione-page-title-container -->
			
			<div class="clear"></div>
		</div> <!-- .row -->
	</div> <!-- #aione_page_header -->
	<div class="main-content">
	
		<h3 class="settings-title">get_organization_id()</h3>
			<div class="docs">
				<pre  class="settings-meta">
					{{get_organization_id()}}
				</pre>
			</div>
		<h3 class="settings-title">get_user_id()</h3>
			<div class="docs">
				<pre  class="settings-meta">
					{{get_user_id()}}
				</pre>
			</div>
		<h3 class="settings-title">get_profile_picture()</h3>
			<div class="docs">
				<pre  class="settings-meta">
					<p>upload_path()</p>
					{{print_r(get_profile_picture())}}
					<p>get_profile_picture(1,null,true)</p>
					{{print_r(get_profile_picture(1,null,true))}}
				</pre>
			</div>
		<h3 class="settings-title">delete_user_meta('user_profile_picture')</h3>
			<div class="docs">
				<pre  class="settings-meta">It will delete user meta
				</pre>
			</div>	
		<h3 class="settings-title">upload_base_path()</h3>
			<div class="docs">
				<pre  class="settings-meta">
					{{upload_base_path()}}
				</pre>
			</div>
		<h3 class="settings-title">upload_path()</h3>
			<div class="docs">
				<pre  class="settings-meta">
					<p>upload_path()</p>
					{{upload_path()}}
					<p>upload_path('user_profile_picture')</p>
					{{upload_path('user_profile_picture')}}
					<p>upload_path('dataset_import_files')</p>
					{{upload_path('dataset_import_files')}}
				</pre>
			</div>
		<h3 class="settings-title">generate_filename()</h3>
			<div class="docs">
				<pre  class="settings-meta">
					<p>generate_filename()</p>
					{{generate_filename()}}
					<p>generate_filename(40,true)</p>
					{{generate_filename(40,true)}}
					<p>generate_filename(40,false)</p>
					{{generate_filename(40,false)}}
					<p>generate_filename(10,true)</p>
					{{generate_filename(10,true)}}
					<p>generate_filename(10,false)</p>
					{{generate_filename(10,false)}}
				</pre>
			</div>
		<h3 class="settings-title">get_meta($model, $uid, $key = null, $column, $array = false)</h3>
			<div class="docs">
				<pre  class="settings-meta">

					<p>get_meta('Organization\UsersMeta',get_user_id()  , $key = 'profilePic', 'user_id', $array = false)
						
					{{-- This will return the Meta of the user by ID. --}}</p>
					{{get_meta('Organization\\UsersMeta',get_user_id() , $key = 'profilePic', 'user_id', $array = false)}}
				</pre>
			</div>
		<h3 class="settings-title">get_meta($model, $uid, $key = null, $column, $array = false)</h3>
			<div class="docs">

				<pre  class="settings-meta">
				<p>get_meta('Organization\UsersMeta', get_user_id(), $key = 'designation', 'user_id', $array = false)</p>
					{{get_meta('Organization\\UsersMeta', get_user_id(), $key = 'designation', 'user_id', $array = false)}}

					{{-- <p>This will return the Meta of the user by ID.you have to pass the following Parameters: </p>
					<table>
						<thead>
							<tr>
								<th>Parameter</th>
								<th>Description</th>
								<th>Required / Optional</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									$model
								</td>
								<td>
									The Model from which you want to get the meta value / values(array).
								</td>
								<td>
									Required
								</td>
							</tr>
							<tr>
								<td>
									$uid
								</td>
								<td>
									The id of user which is related to that specific meta.
								</td>
								<td>
									Required
								</td>
							</tr>
							<tr>
								<td>
									$key
								</td>
								<td>
									The key of meta which the programmer want to get.
								</td>
								<td>
									Optional
								</td>
							</tr>
							<tr>
								<td>
									$column
								</td>
								<td>
									The column from which the user want to compare with the $uid.
								</td>
								<td>
									Required
								</td>
							</tr>
							<tr>
								<td>
									$array
								</td>
								<td>
									If the data is in collection form and you wants in array form just send true.
								</td>
								<td>
									Optional
								</td>
							</tr>
						</tbody>
					</table> --}}
				</pre>
			</div>

		<h3 class="settings-title">get_user_meta($uid, $key = null, $array = false)</h3>
		<div class="docs">
			<pre  class="settings-meta">
					<p>get_user_meta(get_user_id(), $key = 'department', $array = false)</p>
					{{get_user_meta(get_user_id(), $key = 'department', $array = false)}}

				{{-- <p>This will return the Meta from the UsersMeta with $uid.you have to pass the userid as parameter and other two $key and $array is optional</p> --}}
			</pre>
		</div>

		<h3 class="settings-title">get_current_user_meta($key, $array = false)</h3>
		<div class="docs">
			<pre  class="settings-meta">
			<p>get_current_user_meta($key, $array = false)</p>
					{{get_current_user_meta('department', $array = false)}}
				{{-- <p>This will return the Meta of the current user .You have to pass the $key as its attribute and rest $array parameter is optional if you want the result in array.</p> --}}
			</pre>
		</div>
		<h3 class="settings-title">get_user($meta = true ,$array = false, $id = null)</h3>
		<div class="docs">
			<pre  class="settings-meta">
			<p>get_user($meta = 'name' ,$array = false, $id = null)</p>
					{{get_user($meta = true ,$array = false, $id = null)}}
				{{-- <p>In this function all parameter are optional .if you send $meta as false and send $id then you will get the user data which belongs to that specific id .if you just send the $meta and not send the specific id then you will get current user data user data, and if you send the $array as true you will get the data as in array form.</p> --}}
			</pre>
		</div>
		<h3 class="settings-title">update_user_meta($metaKey, $metaValue, $uid = null, $return = false)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>update_user_meta('designation', '50', $uid = get_user_id(), $return = false)</p>
			{{-- update_user_meta($metaKey, $metaValue, $uid = get_user_id(), $return = false) --}}
				{{-- <p>You can use this function when you want to update the user meta . send $metakey as the key of the meta and $metaValue to update the meta .<br> --}}
				{{-- <strong>NOTE: </strong> if you send any specific $uid then meta will update according to $uid and $metaKey else it will update according to current user id and $metaKey. </p> --}}
			</pre>
		</div>
		<h3 class="settings-title">update_user_metas(Array $meta, $uid = null, $return = false)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>update_user_metas(Array $meta, $uid = null, $return = false)</p>
				{{-- <p>if you have the array with the key of meta keys and values as meta values then you can use this function just send the array as $meta.<br>
				<strong>NOTE: </strong>if you send any $uid then meta will update on that specific id alse it will update with current user .
				</p> --}}
			</pre>
		</div>
		<h3 class="settings-title">delete_user_metas(Array $meta, $uid = null)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>delete_user_metas(Array $DeletedArray, $uid = null)</p>
				{{-- <p>If you have a no. of metas to delete you can use this function to delete the multiple records pass your array as $meta.<br>
				<strong>NOTE: </strong>if you send any $uid then meta will delete on that specific id alse it will delete with current user .
				</p> --}}
			</pre>
		</div>
	
		<h3 class="settings-title">delete_user_meta($metaKey, $uid = null)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>delete_user_meta($metaKey, $uid = null)</p>
				{{-- <p>This function will delete the meta related to $metaKey .$uid is option parameter<br>
				<strong>NOTE: </strong>if you send any $uid then meta will delete on that specific id alse it will delete with current user .
				</p> --}}
			</pre>
		</div>

		<h3 class="settings-title">get_organization_meta($key = null, $array = false)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>get_organization_meta($key = null, $array = false)</p>
				{{get_organization_meta($key = null, $array = false)}}
{{-- 				<p>This function will return the meta of the Organization.<br>
				<strong>NOTE: </strong>if you send any $key then meta will delete on that specific id alse it will delete with current user .
				</p>
 --}}			</pre>
		</div>
		<h3 class="settings-title">directory_separator()</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>directory_separator()</p>
				{{directory_separator()}}
			</pre>
		</div>
		<h3 class="settings-title">aione_table($headers = null, $records = null, $style = "default")</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>aione_table($headers = null, $records = null, $style = "default")</p>
				{{aione_table($headers = null, $records = null, $style = "default")}}
			</pre>
		</div>
		<h3 class="settings-title">aione_list($headers = null, $records = null, $style = "default")</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>aione_list($headers = null, $records = null, $style = "default")</p>
				{{aione_list($headers = null, $records = null, $style = "default")}}
			</pre>
		</div>
		<h3 class="settings-title">get_website_alexa_rank( $url = null )</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>get_website_alexa_rank('https://www.youtube.com/?gl=IN')</p>
				{{get_website_alexa_rank( 'https://www.youtube.com/?gl=IN' )}}
			</pre>
		</div>
		<h3 class="settings-title">user_info()</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>user_info()</p>
				{{user_info()}}
			</pre>
		</div>
		<h3 class="settings-title">getMetaValue($metaArray, $metaKey)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>getMetaValue($metaArray, $metaKey) -- discuss</p>
				{{-- {{getMetaValue($metaArray, $metaKey)}} --}}
			</pre>
		</div>
		<h3 class="settings-title">role_id()</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>role_id()</p>
				{{dump(role_id())}}
			</pre>
		</div>
		<h3 class="settings-title">setting_val_by_key($key)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>setting_val_by_key($key) -- discuss</p>
				{{setting_val_by_key('show_title')}}
			</pre>
		</div>
		<h3 class="settings-title">check_route_permisson($url)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>check_route_permisson($url) -- discuss</p>
				{{setting_val_by_key('http://master.adminpie.com/docs')}}
			</pre>
		</div>
		<h3 class="settings-title">check_route_permisson($url)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>check_route_permisson($url) -- discuss</p>
				{{setting_val_by_key('http://master.adminpie.com/docs')}}
			</pre>
		</div>
		<h3 class="settings-title">activity_log($slug, $slug)</h3>
		<div class="docs">
			<pre class="settings-meta">
			<p>activity_log($slug, $slug) -- discuss</p>
				{{-- {{activity_log($slug, $slug)}} --}}
			</pre>
		</div>
		{{--
		<h3 class="settings-title">get_user_meta()</h3>
		<pre  class="settings-meta">
			<p>get_user_meta()</p>
			{{get_user_meta()}}
			<p>get_user_meta(true,true)</p>
			{{print_r(get_user(true,true,2))}}
		</pre>
		<h3 class="settings-title">get_user()</h3>
		<pre  class="settings-meta">
			<p>get_user()</p>
			{{get_user()}}
			<p>get_user(true,true)</p>
			{{print_r(get_user(true,true,2))}}
		</pre>
		
		--}}
		
	</div>
<style type="text/css">
h3{
	margin: 20px 0 0 0;
    color: #03A9F4;
}
pre{
	padding: 20px 0;
    margin: 16px 0;
    border: 1px solid #e8e8e8;
    text-indent: 0px;
    background: #f8f8f8;
}
pre p{
	padding: 0 20px;
    color: #F44336;
}
</style>
@endsection