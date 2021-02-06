<html>
<head>
	<title>مشاهده پایان نامه</title>
	<link rel="stylesheet" type="text/css" href="http://pc.iaun.ac.ir/assets/view_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script type="text/javascript" src="http://pc.iaun.ac.ir/assets/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="http://pc.iaun.ac.ir/assets/jquery.jscroll.js"></script>
	<script type="text/javascript" src="http://pc.iaun.ac.ir/assets/script.js"></script>
</head>
<body>

<div class="wrapper">
    @if($graphical)
    <table class="table table-bordered mt-5 table-striped">
    <thead>
        <tr>
        <th scope="col">عنوان</th>
        <th scope="col">درصد مشابهت</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results['internal'] as $item)
            <tr>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['copyPercent'] }}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
    @else
	<div class="content">
		{!! implode('<div>', $reports) !!}
    </div>
    @endif
</div>

</body>
</html>
