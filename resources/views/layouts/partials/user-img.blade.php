<img
    @if(file_exists(public_path('uploads/avatar/'.$user->id . '/' . $user->file)) && !empty($user->file))
        src="{{ asset('uploads/avatar/'.$user->id . '/' . $user->file)  }}"
    @else
        src="{{ asset('uploads/avatar/default/user icon.png')  }}"
    @endif
    alt="" class="img-fluid sidebar-user-icon">
