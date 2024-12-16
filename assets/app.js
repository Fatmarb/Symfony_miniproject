import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
// assets/app.js
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'bootstrap-datepicker';
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css';


// Initialize DataTables for tables with the `.datatable` class
$(document).ready(function() {
    $('.datatable').DataTable();
});


console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
