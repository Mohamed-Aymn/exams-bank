<!-- main js file -->
@vite('resources/js/app.js')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

@if(Request::url() === "http://127.0.0.1:8000/manage")
    @vite('resources/js/routers/adminManagePageRouter.js')
@endif

@if(Request::url() === "http://127.0.0.1:8000/exam")
    @vite('resources/js/routers/examRouter.js')
@endif