import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;
window.$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
