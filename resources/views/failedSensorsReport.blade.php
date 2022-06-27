<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <style>
            @import url("https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
            .project-tab {
                padding: 10%;
                margin-top: -8%;
            }
            .project-tab #tabs {
                background: #007b5e;
                color: #eee;
            }
            .project-tab #tabs h6.section-title {
                color: #eee;
            }
            .project-tab #tabs .nav-tabs .nav-item.show .nav-link,
            .nav-tabs .nav-link.active {
                color: #0062cc;
                background-color: transparent;
                border-color: transparent transparent #f3f3f3;
                border-bottom: 3px solid !important;
                font-size: 16px;
                font-weight: bold;
            }
            .project-tab .nav-link {
                border: 1px solid transparent;
                border-top-left-radius: 0.25rem;
                border-top-right-radius: 0.25rem;
                color: #0062cc;
                font-size: 16px;
                font-weight: 600;
            }
            .project-tab .nav-link:hover {
                border: none;
            }
            .project-tab thead {
                background: #f3f3f3;
                color: #333;
            }
            .project-tab a {
                text-decoration: none;
                color: #333;
                font-weight: 600;
            }

            .pcs:after {
                content: " pcs";
            }

            .cur:before {
                content: "$";
            }

            .per:after {
                content: "%";
            }

            * {
                box-sizing: border-box;
            }

            body {
                padding: 0.2em 2em;
            }

            table {
                width: 100%;
            }
            table th {
                text-align: left;
                border-bottom: 1px solid #ccc;
            }
            table th, table td {
                padding: 0.4em;
            }

            table.fold-table > tbody > tr.view td, table.fold-table > tbody > tr.view th {
                cursor: pointer;
            }
            table.fold-table > tbody > tr.view td:first-child,
            table.fold-table > tbody > tr.view th:first-child {
                position: relative;
                padding-left: 20px;
            }
            table.fold-table > tbody > tr.view td:first-child:before,
            table.fold-table > tbody > tr.view th:first-child:before {
                position: absolute;
                top: 50%;
                left: 5px;
                width: 9px;
                height: 16px;
                margin-top: -8px;
                font: 16px fontawesome;
                color: #999;
                content: "";
                transition: all 0.3s ease;
            }
            table.fold-table > tbody > tr.view:nth-child(4n-1) {
                background: #eee;
            }
            /*table.fold-table > tbody > tr.view:hover {
                background: #000;
            }*/
            table.fold-table > tbody > tr.view.open {
                background: tomato;
                color: white;
            }
            table.fold-table > tbody > tr.view.open td:first-child:before, table.fold-table > tbody > tr.view.open th:first-child:before {
                transform: rotate(-180deg);
                color: #333;
            }
            table.fold-table > tbody > tr.fold {
                display: table-row;
            }
            table.fold-table > tbody > tr.fold.open {
                display: table-row;
            }

            .fold-content {
                padding: 0.5em;
            }
            .fold-content h3 {
                margin-top: 0;
            }
            .fold-content > table {
                border: 2px solid #ccc;
            }
            .fold-content > table > tbody tr:nth-child(even) {
                background: #eee;
            }

        </style>
    </head>
    <body>
        <section id="tabs" class="project-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-{!! App\Enums\FaceList::NORTH!!}-tab" data-toggle="tab" href="#nav-{!! App\Enums\FaceList::NORTH!!}" role="tab" aria-controls="nav-home" aria-selected="true">{!! strtoupper(App\Enums\FaceList::NORTH) !!} SIDE</a>
                                <a class="nav-item nav-link" id="nav-{!! App\Enums\FaceList::NORTH!!}-tab" data-toggle="tab" href="#nav-{!! App\Enums\FaceList::EAST!!}" role="tab" aria-controls="nav-{!! App\Enums\FaceList::EAST!!}" aria-selected="false">{!! strtoupper(App\Enums\FaceList::EAST) !!} SIDE</a>
                                <a class="nav-item nav-link" id="nav-{!! App\Enums\FaceList::SOUTH!!}-tab" data-toggle="tab" href="#nav-{!! App\Enums\FaceList::SOUTH!!}" role="tab" aria-controls="nav-{!! App\Enums\FaceList::SOUTH!!}" aria-selected="false">{!! strtoupper(App\Enums\FaceList::SOUTH) !!} SIDE</a>
                                <a class="nav-item nav-link" id="nav-{!! App\Enums\FaceList::EAST!!}-tab" data-toggle="tab" href="#nav-{!! App\Enums\FaceList::WEST!!}" role="tab" aria-controls="nav-{!! App\Enums\FaceList::WEST!!}" aria-selected="false">{!! strtoupper(App\Enums\FaceList::WEST) !!} SIDE</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach ($weeklyData as $key => $faceData)
                                <div class="tab-pane fade" id="nav-{{ $key }}" role="tabpanel" aria-labelledby="nav-{{ $key }}-tab">
                                    @foreach ($faceData as $dateKey => $weeklyDatas)
                                        <div class="fold-content">
                                            <h3>{{ date('F j', strtotime($dateKey)) }}</h3>
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th colspan="5">Time</th>
                                                    <th colspan="5">Avarage Temperature</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($weeklyDatas as $data)
                                                        <tr>
                                                            <th colspan="5">{{ $data['hour'].":00"}}</th>
                                                            <th colspan="5">{{ $data['avg']."°"}}</th>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
