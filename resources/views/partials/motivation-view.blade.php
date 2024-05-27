<style>
    .motivationViewContainer iframe{
        border: 0;
        min-height: 500px;
        width: 100%;
    }
    .modal-body{
        background-color: black;
    }
</style>
<div class="container-fluid motivationViewContainer">
    <iframe src="https://www.youtube.com/embed/{{$id}}?si=2QqItN2qqK5OQ8kQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    <button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">Close</button>
</div>