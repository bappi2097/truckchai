@extends('company.layout.master')
@section('content')
    <div class="bg-white p-20 col-md-10 m-t-30">
        <form action="{{ route('company.my-profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <fieldset>
                <img id="user-image" src="{{ asset(!empty($user->company) ? $user->company->image : 'images/user.png') }}"
                    alt="your image" width="118" height="122" /><br>
                <input type='file' name="image" id="user-image-btn" style="display: none;" onchange="readURL(this);"
                    accept="image/*" />
                <input type="button" class="btn btn-outline-secondary" value="Update Image"
                    onclick="document.getElementById('user-image-btn').click();" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="John Doe"
                                value="{{ $user->name }}" required>
                            @error('name')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="john.doe@mail.com"
                                value="{{ $user->email }}" required>
                            @error('email')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile_no">Mobile No</label>
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no"
                                placeholder="+97XXXXXXXX" value="{{ $user->mobile_no }}" required>
                            @error('mobile_no')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="24/B Baker Street" @if (!empty($user->company)) value="{{ $user->company->address }}" @endif required>
                            @error('address')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company_type_id">Company Type</label>
                            <select name="company_type_id" id="company_type_id" class="form-control">
                                <option> Choose </option>
                                @foreach ($companyTypes as $companyType)
                                    <option value="{{ $companyType->id }}"
                                        {{ selected($companyType->id, $user->company ? $user->company->company_type_id : '') }}>
                                        {{ $companyType->name }}</option>
                                @endforeach
                            </select>
                            @error('company_type_id')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account_name">Account Name</label>
                            <input type="text" class="form-control" name="account_name" @if (!empty($user->company)) value="{{ $user->company->account_name }}" @endif
                                required>
                            @error('account_name')
                                <span class="text-red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary m-r-5">Save</button>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-default">Cancel</a>
            </fieldset>
        </form>
    </div>
@endsection
@push('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#user-image')
                        .attr('src', e.target.result)
                        .width(105)
                        .height(112);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endpush
