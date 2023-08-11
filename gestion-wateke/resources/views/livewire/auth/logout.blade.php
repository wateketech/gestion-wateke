<div>
    <i class="fa fa-sign-out me-sm-1 {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-dark' : '' }}"></i>
    <span class="d-sm-inline d-none {{ in_array(request()->route()->getName(),['profile', 'my-profile']) ? 'text-dark' : '' }}" wire:click="logout">{{ __('Sign out') }}</span>
</div>
