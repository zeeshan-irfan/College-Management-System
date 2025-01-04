<x-form-template id="passwordUpdateForm" method="PUT"
                 route="password.update" 
                 heading="Update Password" 
                 subheading="Ensure your account is using a long, random password to stay secure.">



                 <div class="mb-3">
                    <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                    <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="mb-3">
                    <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>


</x-form-template>

