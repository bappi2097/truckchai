<img id="user-image" style="width: 180px; height: 180px;" src="{{asset('images/admin.png')}}" alt="your image" /><br>
<input type='file' name="image" id="user-image-btn" style="display: none;" onchange="readURL(this);" accept="image/*" />
<input type="button" class="btn btn-outline-secondary" style="width: 180px;" value="Update Image"
    onclick="document.getElementById('user-image-btn').click();" />

<img id="user-image" style="width: 180px; height: 180px;"
    src="{{asset(!empty($user->admin->image) ? $user->admin->image : 'images/admin.png')}}" alt="your image" /><br>
<input type='file' name="image" id="user-image-btn" style="display: none;" onchange="readURL(this);" accept="image/*" />
<input type="button" class="btn btn-outline-secondary" style="width: 180px;" value="Update Image"
    onclick="document.getElementById('user-image-btn').click();" />

@push('script')
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#user-image')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
@endpush