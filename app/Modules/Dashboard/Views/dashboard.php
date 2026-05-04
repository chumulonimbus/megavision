<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div>
    <div class="flex justify-between items-start mb-6">
        <div class="flex gap-6">
            <div class="bg-blue-600 text-white p-6 rounded-2xl shadow-sm flex justify-between items-start w-72">
                <div>
                    <h3 class="text-lg font-medium mb-4">Total Sales</h3>
                    <h2 class="text-3xl font-bold mb-1">21.324</h2>
                    <p class="text-sm text-blue-200">+ 2.031</p>
                </div>
                <div class="text-2xl opacity-80">
                    <i class="fas fa-shopping-bag"></i>
                </div>
            </div>
            <div class="bg-white text-gray-800 border border-gray-200 p-6 rounded-2xl shadow-sm flex justify-between items-start w-72">
                <div>
                    <h3 class="text-lg font-medium mb-4">Total Income</h3>
                    <h2 class="text-3xl font-bold mb-1">$ 221,324.50</h2>
                    <p class="text-sm text-gray-400">-$ 2,201</p>
                </div>
                <div class="text-2xl opacity-80">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-400 rounded flex items-center px-3 py-1 mt-2 shadow-sm cursor-pointer hover:bg-gray-50">
            <input type="text" id="date_range" placeholder="Pick date" class="text-sm text-gray-700 bg-transparent outline-none w-44 cursor-pointer" readonly>
            <i class="far fa-calendar-alt text-gray-600"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="header mb-4">
            <p class="text-xl text-gray-600 font-semibold mb-0">Sales Performance</p>
        </div>
        <div class="w-full h-72">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <div class="header mb-4">
            <p class="text-xl text-gray-600 font-semibold mb-0">Recent Order</p>
            <!-- <p class="text-base text-gray-500">subtitle</p> -->
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="border-b">
                    <tr>
                        <th class="py-3 px-4 align-top font-semibold w-48">
                            <div class="mb-4 flex items-center justify-between cursor-pointer hover:text-blue-600 sortable" data-column="client_name">
                                Name <i class="fas fa-sort ml-2 text-gray-400"></i>
                            </div>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Search" data-column="client_name" class="search-input border border-gray-400 rounded-full pl-8 pr-3 py-1 text-xs w-full focus:outline-none focus:border-blue-500">
                            </div>
                        </th>
                        <th class="py-3 px-4 align-top font-semibold w-48">
                            <div class="mb-4 flex items-center justify-between cursor-pointer hover:text-blue-600 sortable" data-column="order_date">
                                Oder Date <i class="fas fa-sort ml-2 text-gray-400"></i>
                            </div>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Search" data-column="order_date" class="search-input border border-gray-400 rounded-full pl-8 pr-3 py-1 text-xs w-full focus:outline-none focus:border-blue-500">
                            </div>
                        </th>
                        <th class="py-3 px-4 align-top font-semibold w-48">
                            <div class="mb-4 flex items-center justify-between cursor-pointer hover:text-blue-600 sortable" data-column="order_amount">
                                Oder Amount <i class="fas fa-sort ml-2 text-gray-400"></i>
                            </div>
                        </th>
                        <th class="py-3 px-4 align-top font-semibold w-48">
                            <div class="mb-4 flex items-center justify-between cursor-pointer hover:text-blue-600 sortable" data-column="client_phone">
                                Phone <i class="fas fa-sort ml-2 text-gray-400"></i>
                            </div>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Search" data-column="client_phone" class="search-input border border-gray-400 rounded-full pl-8 pr-3 py-1 text-xs w-full focus:outline-none focus:border-blue-500">
                            </div>
                        </th>
                        <th class="py-3 px-4 align-top font-semibold w-48">
                            <div class="mb-4 flex items-center justify-between cursor-pointer hover:text-blue-600 sortable" data-column="sp_name">
                                Sales <i class="fas fa-sort ml-2 text-gray-400"></i>
                            </div>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Search" data-column="sp_name" class="search-input border border-gray-400 rounded-full pl-8 pr-3 py-1 text-xs w-full focus:outline-none focus:border-blue-500">
                            </div>
                        </th>
                        <th class="py-3 px-4 align-top font-semibold w-48">
                            <div class="mb-4 flex items-center justify-between cursor-pointer hover:text-blue-600 sortable" data-column="sp_office">
                                Office <i class="fas fa-sort ml-2 text-gray-400"></i>
                            </div>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text" placeholder="Search" data-column="sp_office" class="search-input border border-gray-400 rounded-full pl-8 pr-3 py-1 text-xs w-full focus:outline-none focus:border-blue-500">
                            </div>
                        </th>
                        <th class="py-3 px-4 align-top w-20">
                            <div class="mb-4">Action</div>
                        </th>
                    </tr>
                </thead>

                <tbody id="table-body"></tbody>

            </table>
        </div>

        <div id="pagination-container" class="flex justify-center mt-6 gap-2 text-sm"></div>
        
    </div>
</div>

<script>
    let sortColumn = 'order_date'
    let sortDirection = 'DESC'
    let startDate = ''
    let endDate = ''

    let page = 1
    let perPage = 10

    const headers = {
        'Content-type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }

    flatpickr('#date_range', {
        mode: 'range',
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'd/m/Y',
        onChange: (selectedDates, dateStr, instance)=>{
            if(selectedDates.length === 2){
                startDate = instance.formatDate(selectedDates[0], "Y-m-d")
                endDate = instance.formatDate(selectedDates[1], "Y-m-d")
                page = 1
                getData()
            } else {
                startDate = ''
                endDate = ''
                page = 1
                getData()
            }
        }
    })

    const salesChartContainer = document.getElementById('salesChart').getContext('2d')
    const renderSalesChart = (data, labels) => {
        new Chart(salesChartContainer, {
            type: 'line',
            data: {
                labels: labels,
                datasets: data
            },
            options: {
                responseive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: { y: { display: false }, x: { grid: { display: false } } }
            }
        })
    }
    
    const getData = () => {
        let searchData = {}
        document.querySelectorAll('.search-input').forEach(input => {
            if(input.value.trim() !== ''){
                searchData[input.getAttribute('data-column')] = input.value
            }
        })

        const payload = {
            start_date: startDate,
            end_date: endDate,
            search: searchData,
            sort_column: sortColumn,
            sort_direction: sortDirection,
            page,
            per_page: perPage
        }

        fetch('<?= base_url('/dashboard/getData') ?>', {
            method: 'POST',
            headers,
            body: JSON.stringify(payload)
        })
        .then(respon => respon.json())
        .then(res => {
            if(res.status === 'success'){
                renderTable(res.data)
                renderPagination(res.pagination)
            }
        })
        .catch(err => {
            console.log('Error', err)
        })
    }

    const getReportSales = () => {
        fetch('<?= base_url('/dashboard/getReport') ?>', {
            method: 'GET',
            headers,
        }).then(res => res.json())
        .then(res => {
            const dataset = res.data.map((el)=>{
                const dataAmount = el.history.map(item => item.total)
                return {
                    label: el.sales,
                    data: dataAmount,
                    tension: 0.4
                }
            })
            const monthLabel = [...new Set(res.data.flatMap(item => item.history.map(el => el.month)))]
            renderSalesChart(dataset, monthLabel)
        })
        .catch(err => console.log('Error',err))
    }

    const renderTable = (data) => {
        const tbody = document.getElementById('table-body');
        tbody.innerHTML = '';

        if(data.length === 0){
            tbody.innerHTML = '<tr><td colspan="7" class="py-4 text-center text-gray-500">Data kosong</td></tr>';
            return;
        }

        data.forEach((row, index) => {
            let amount = new Intl.NumberFormat('id-ID').format(row.order_amount)
            let date = new Date(row.order_date)
            let formatedDate = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })

            let tr = document.createElement('tr')
            tr.className = "border-b hover:bg-gray-50 text-gray-800"
            tr.innerHTML = `
                <td class="py-4 px-4">${row.client_name}</td>
                <td class="py-4 px-4">${formatedDate}</td>
                <td class="py-4 px-4 text-center">${amount}</td>
                <td class="py-4 px-4 text-center">${row.client_phone}</td>
                <td class="py-4 px-4">${row.sp_name}</td>
                <td class="py-4 px-4">${row.sp_office}</td>
                <td class="py-4 px-4"><a href="#" class="text-gray-600 underline text-xs font-semibold">Details</td>
            `;
            tbody.appendChild(tr);
        })
    }

    const renderPagination = (pagination) => {
        const paginationContainer = document.getElementById('pagination-container')
        paginationContainer.innerHTML = ''

        if(pagination.total_pages <= 1) return

        if(pagination.current_page > 1){
            paginationContainer.innerHTML += `
                <button onclick="changePage(${pagination.current_page - 1})" class="px-3 py-1 bg-white border border-gray-200 rounded hover:bg-gray-100">
                <i class="fa-solid fa-angles-left"></i>
                </button>
            `;
        }

        let startPage = Math.max(1, pagination.current_page - 2)
        let endPage = Math.min(pagination.total_pages, startPage + 5)

        for(let i = startPage; i < endPage; i++){
            let activeClass = (i === pagination.current_page) ?
                'bg-gray-800 text-white font-bold border-gray-800' :
                'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'
            
            paginationContainer.innerHTML += `<button onclick="changePage(${i})" class="px-3 py-1 border rounded ${activeClass}">${i}</button>`;
        }

        if(pagination.current_page < pagination.total_pages){
            paginationContainer.innerHTML += `
                <button onclick="changePage(${pagination.current_page + 1})" class="px-3 py-1 bg-white border border-gray-200 rounded hover:bg-gray-100">
                <i class="fa-solid fa-angles-right"></i>
                </button>
            `;
        }
    }

    window.changePage = (toPage) => {
        page = toPage
        getData()
    }

    let searchTimeout
    document.querySelectorAll('.search-input').forEach(input => {
        input.addEventListener('keyup', ()=>{
            clearTimeout(searchTimeout)
            searchTimeout = setTimeout(()=>{
                page = 1
                getData()
            }, 500)
        })
    })

    document.querySelectorAll('.sortable').forEach(header => {
        header.addEventListener('click', ()=>{
            let column = header.getAttribute('data-column')
            if(sortColumn === column){
                sortDirection = sortDirection == 'ASC' ? 'DESC' : 'ASC'
            } else {
                sortColumn = column
                sortDirection = 'ASC'
            }
            page = 1
            getData()
        })
    })

    document.addEventListener("DOMContentLoaded", ()=>{
        getData()
        // real data
        // getReportSales()

        // chart hardcode
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May']
        const datasets = [
            { label: 'Sales A', data: [30, 50, 40, 70, 50], borderColor: '#6b7280', tension: 0.4 },
            { label: 'Sales B', data: [40, 70, 50, 80, 60], borderColor: '#d97706', tension: 0.4 },
            { label: 'Sales C', data: [50, 60, 45, 90, 40], borderColor: '#db2777', tension: 0.4 },
            { label: 'Sales D', data: [20, 40, 30, 60, 70], borderColor: '#2563eb', tension: 0.4 }
        ]
        renderSalesChart(datasets, labels)
    })
</script>
<?= $this->endSection() ?>