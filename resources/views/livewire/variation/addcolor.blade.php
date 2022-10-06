<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Colour</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form wire:submit.prevent="insert_color">
                    @csrf
                    <div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Color name</label>
                        <div class="input-group mx-3">
                            <input type="text" wire:model="color_name" class="form-control">
                            @error('color_name') <p class="text-danger fw-bold w-100 mb-0">{{ $message }}</p> @enderror
                        </div>
                        <label class="col-sm-3 col-form-label mt-3">Color code</label>
                        <div class="input-group mx-3">
                            <input type="color" wire:model="color_code">
                            @error('color_code') <p class="text-danger fw-bold w-100 mb-0">{{ $message }}</p> @enderror
                        </div>
                        <div class="col-sm-4 mt-3">
                            <button type="submit" class="btn btn-info btn-sm">Add Colour</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th>Colour Name</th>
                                <th>Colour Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                            <tr>
                                <td>{{ Str::title($color->color_name) }}</td>
                                <td>
                                    <span class="badge @if ($color->color_code != '#ffffff') text-white @endif" style="background: {{ $color->color_code }}">{{ $color->color_code }}</span>
                                </td>
                                <td>
                                    <button wire:click="delete_color({{$color->id}})" class="btn btn-danger btn-sm">Delete</button>
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
