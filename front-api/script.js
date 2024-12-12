function fetchAll() {
    fetch("http://learn-api-php-native-fiq.test/api/categories.php")
        .then(resp => {
            if (!resp.ok) {
                throw new Error("Network response was not ok: " + resp.statusText);
            }
            return resp.json();
        })
        .then(data => {
            console.table(data);
            $("#data").html("");
            data.data.forEach((item, index) => {
                console.table(item.id);
                
                $("#data").append(
                    `
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            ${++index}
                        </th>
                        <td class="px-6 py-4">
                            ${item.name}
                        </td>
                        <td class="px-6 py-4">
                            <button id="${item.id}" onclick="deleteItem(this.id)" class="bg-red-600 text-white px-3 py-2 rounded-xl"> 
                                Delete
                            </button>
                        </td>
                    </tr>
                  `
                );
            });
        })
        .catch(error => {
            console.error("There was an error fetching the data:", error);
        });
}

function deleteItem(id) {
    $.ajax({
        url: `http://learn-api-php-native-fiq.test/api/categories.php?id=${id}`,
        method: "DELETE",
        success: (resp) => {
            alert("Berhasil hapus data");
            fetch();
        },
        error: (resp) => {
            alert("Gagal hapus data");
        }
    })
}


    $("#add_category").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "http://learn-api-php-native-fiq.test/api/categories.php",
            type: "POST",
            data: $(this).serialize(),
            success: function (resp) {
                alert("Berhasil");
                console.log(resp);
                fetchAll();
            },
            error: function (resp) {
                alert("Gagal");
                console.log(resp);
            }
        })
    })

    $(document).ready(function () {
        fetchAll();
    });
