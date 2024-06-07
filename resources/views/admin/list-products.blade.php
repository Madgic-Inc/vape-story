@extends('adminlte::page')

@section('content')
    @vite(['resources/js/app.js'])
    @include('layouts.alert')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product List</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            .table th,
            .table td {
                vertical-align: middle;
            }

            .product-image {
                max-width: 50px;
                max-height: 50px;
                margin-right: 10px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Product List</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Estoque</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr @if ($product->stock < 0) style="background: red" @endif>

                            <td>
                                <img width="30" height="30" src="{{ asset('storage/' . $product->image) }}" />
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>

                            <td>
                                {{ $product->description }}
                            </td>

                            <td>
                                {{ $product->value }}
                            </td>

                            <td>
                                {{ $product->stock }}
                            </td>

                            <td data-toggle="modal" data-target="#edit-product-modal-{{ $product->id }}">
                                <button class="btn btn-outline-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                    </svg>
                                </button>
                                <button class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <div id="edit-product-modal-{{ $product->id }}" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <form method="POST" action="/update-product/{{ $product->id }}">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $product->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <span class="">Nome</span>
                                                <input class="form-control" type="text" name="name"
                                                    value={{ $product->name }}>
                                            </div>
                                            <div class="form-group">
                                                <span class="">Descrição</span>
                                                <input class="form-control" type="text" name="description"
                                                    value={{ $product->description }}>
                                            </div>
                                            <div class="form-group">
                                                <span class="">Valor</span>
                                                <input class="form-control" type="number" name="value"
                                                    value={{ $product->value }}>
                                            </div>
                                            <div class="form-group">
                                                <span class="">Estoque</span>
                                                <input class="form-control" type="number" name="stock"
                                                    value={{ $product->stock }}>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>


    </body>

    </html>
@endsection
