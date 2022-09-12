<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Size</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form wire:submit.prevent="insert_size">
                    @csrf
                    <div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Size</label>
                        <div class="input-group mx-3">
                            <input type="text" wire:model="size" class="form-control">
                            <div class="input-group-append">
                                <select class="form-control" style="border-radius: 0 1.25rem 1.25rem 0" wire:model="measure">
                                    <option value=""></option>
                                    <option value="inch">inch</option>
                                    <option value="m">m</option>
                                    <option value="cm">cm</option>
                                    <option value="l">l</option>
                                    <option value="kg">kg</option>
                                    <option value="g">g</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 mt-3">
                            <button type="submit" class="btn btn-info btn-sm">Add Size</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Measure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sizes as $size)
                            <tr>
                                <td>{{ $size->size }}</td>
                                <td>{{ $size->measure }}</td>
                                <td>
                                    <button wire:click="delete_size({{$size->id}})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
