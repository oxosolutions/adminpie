@foreach($model as $key => $file)
	@if($file->extension == 'pdf')
		<div gallery-item-id="{{ $file->id }}" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-pdf-o icon-logo" aria-hidden="true"></i>	
			</div>
			
			<div class="desc">
				{{ $file->original_name }}<br><span class="size">size: {{ number_format($file->size / 1024, 2) . ' KB' }}</span>
			</div>
		</div>
	@elseif($file->extension == 'jpg' || $file->extension == 'jpeg' || $file->extension == 'png')
		<div gallery-item-id="{{ $file->id }}" class="gallery-item">
			<img src="{{ asset(upload_path('media'))}}/{{ $file->original_name }}">
			<div class="desc">
				{{ $file->original_name }}<br><span class="size">size: {{ number_format($file->size / 1024, 2) . ' KB' }}</span>
			</div>
		</div>
	@elseif($file->extension == 'docx' || $file->extension == 'doc')
		<div gallery-item-id="{{ $file->id }}" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-text-o icon-logo" aria-hidden="true"></i>
			</div>
			<div class="desc">
				{{ $file->original_name }}<br><span class="size">size: {{ number_format($file->size / 1024, 2) . ' KB' }}</span>
			</div>
		</div>
	@elseif($file->extension == 'mp4')
		<div gallery-item-id="{{ $file->id }}" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-video-o icon-logo" aria-hidden="true"></i>
			</div>
			<div class="desc">
				{{ $file->original_name }}<br><span class="size">size: {{ number_format($file->size / 1024, 2) . ' KB' }}</span>
			</div>
		</div>
	@elseif($file->extension == 'mp3')
		<div gallery-item-id="{{ $file->id }}" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-audio-o icon-logo" aria-hidden="true"></i>
			</div>
			<div class="desc">
				{{ $file->original_name }}<br><span class="size">size: {{ number_format($file->size / 1024, 2) . ' KB' }}</span>
			</div>
		</div>
	@endif
@endforeach