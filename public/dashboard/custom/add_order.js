$(document).ready(function () {
    $(".add_order").on('click', function (e) {
        e.preventDefault();

        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $(this).data('price');
        $(this).removeClass('btn-success').addClass('btn-danger disabled');
        var html =
            `<tr>
        <td>${name}</td>
        <td>
            <input type="number" name="quantities[]"  data-price="${price}" class="form-control input-sm product_qty" min="1" value="1">
        </td>
        <td class="product_price" id="product_price">${price}</td>
        <td>
            <a class="btn btn-danger m-2 remove-btn"  data-id="${id}">
                <i class="fa fa-trash"></i>
            </a>
        </td>
        </tr>`;

        $(".order_list").append(html);
        calculate_total();
        $('body').on('click', '.disabled', function (e) {
            e.preventDefault();
        });

        $('body').on('click', '.remove-btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            // alert(id);
            $('#product_' + id).removeClass('btn-danger disabled').addClass('btn-success');
            $(this).closest('tr').remove();

            calculate_total();
        });


        function calculate_total() {
            var price = 0;
            $(".order_list .product_price").each(function (index) {
                price += parseInt($(this).html());
            });
            $('#total_price').html(price);
        }

        $(".product_qty").on('change', function () {
            var qty = parseInt($(this).val());
            var product_price = $(this).data('price');
            new_price = qty * product_price;
            $(this).closest('tr').find(".product_price").html(new_price);
            calculate_total();
        });


        if (price > 0) {
            $("#add_order_btn").removeClass('disabled');
        }else{
            $("#add_order_btn").addClass('disabled');
        }
    });
});