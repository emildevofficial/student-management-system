@extends('layout')
@section('content')
<div class="card"><div class="card-header">Record Payment</div><div class="card-body">
<form action="{{ route('payments.store') }}" method="post">@csrf

@if ($errors->any())
	<div class="mb-3 p-3 bg-red-50 border border-red-200 text-red-700 rounded">
		<ul class="mb-0">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<label>Student</label>
<select name="student_id" class="form-control" required>
		<option value="">-- choose student --</option>
		@foreach($students as $s)
				<option value="{{ $s->id }}" {{ old('student_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
		@endforeach
</select>
<br>
<label>Amount</label>
<input name="amount" class="form-control" type="number" step="0.01" value="{{ old('amount') }}"><br>
<button type="submit" class="btn btn-primary">Save</button>
</form>
</div></div>
@endsection
