@extends('design.header')

@section('content')
    @include('design.navbar')
    @include('design.sidebar')

    <div class="p-6 sm:ml-64 mt-10">
        <div class="bg-white p-8 rounded-lg shadow-lg dark:border-gray-700 dark:bg-gray-900">
            <div class="mb-6">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-white">Booking Check Out</h2>
            </div>
            <form action="{{ route('bookings.checkOut', $booking->id) }}" method="POST"
                enctype="multipart/form-data" class="w-full max-w-2xl mx-auto">
                @csrf
                @method('PATCH')
                <div class="space-y-6">
                    <!-- Room Name -->
                    <div>
                        <label for="room_name" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Room
                            Name</label>
                        <input type="text" value="{{ $booking->room->name }}" name="room_name" id="room_name"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            required>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" value="{{ $booking->name }}" name="name" id="name"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" value="{{ $booking->email }}" name="email" id="email"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            required>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact_no" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Contact
                            Number</label>
                        <input type="text" value="{{ $booking->contact_no }}" name="contact_no" id="contact_no"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="check_in_date"
                                class="block text-lg font-medium text-gray-700 dark:text-gray-300">Check in date</label>
                            <input type="text"
                                value="{{ \Carbon\Carbon::parse($booking->check_in_date)->format('M-d-Y') }}"
                                name="check_in_date" id="check_in_date"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                                required>
                        </div>
                        <div>
                            <label for="check_out_date"
                                class="block text-lg font-medium text-gray-700 dark:text-gray-300">Check out date</label>
                            <input type="text"
                                value="{{ \Carbon\Carbon::parse($booking->check_out_date)->format('M-d-Y') }}"
                                name="check_out_date" id="check_out_date"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                                required>
                        </div>
                    </div>

                    <!-- Room Price -->
                    <div>
                        <label for="room_price" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Room
                            Price</label>
                        <input type="number" value="{{ $booking->room->price }}" name="room_price" id="room_price"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            readonly>
                    </div>

                    <!-- Payment Amount -->
                    <div>
                        <label for="payment" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Payment
                            Amount</label>
                        <input type="number" value="{{ $booking->payment }}" name="payment" id="payment"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            required>
                    </div>

                    <!-- Remaining Balance -->
                    <div>
                        <label for="remaining_balance"
                            class="block text-lg font-medium text-gray-700 dark:text-gray-300">Remaining Balance</label>
                        <input type="number" name="remaining_balance" id="remaining_balance"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            readonly>
                    </div>

                    <!-- Final Payment -->
                    <div>
                        <label for="final_payment" class="block text-lg font-medium text-gray-700 dark:text-gray-300">Final
                            Payment</label>
                        <input type="number" name="final_payment" id="final_payment"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-md p-3 dark:bg-gray-800 dark:text-gray-100 dark:border-gray-600"
                            readonly>
                    </div>

                    <!-- Payment Picture -->
                    <div class="mb-4">
                        <button type="button" data-twe-toggle="modal" data-twe-target="#exampleModalCenter"
                            data-twe-ripple-init data-twe-ripple-color="light">
                            <label for="payment_picture"
                                class="block text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Payment
                                Picture</label>
                            <img src="{{ $booking->paymentRecord && $booking->paymentRecord->payment_path ? asset('storage/' . $booking->paymentRecord->payment_path) : asset('images/lake-sebu.jpg') }}"
                                alt="No Payment Screenshot"
                                class="w-40 h-40 rounded-lg shadow-md object-cover border border-gray-200 dark:border-gray-700">
                        </button>
                    </div>

                    <!-- Status -->
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" onclick="window.location.href='{{ route('resort.booking') }}'"
                        class="px-6 py-3 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancel</button>
                    <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
                </div>
            </form>
        </div>
    </div>



    <!-- Image Modal -->
    <div data-twe-modal-init
        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
        id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
        <div data-twe-modal-dialog-ref
            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
            <div
                class="pointer-events-auto m-5 relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none dark:bg-surface-dark">
                <img src="{{ $booking->paymentRecord && $booking->paymentRecord->payment_path ? asset('storage/' . $booking->paymentRecord->payment_path) : asset('images/lake-sebu.jpg') }}"
                    alt="No Payment Screenshot"
                    class=" w-full h-[450px] sm:h-[400px] md:h-[500px] lg:h-[600px] xl:h-[700px] rounded-lg shadow-md object-cover border border-gray-200 dark:border-gray-700">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentInput = document.getElementById('payment');
            const roomPriceInput = document.getElementById('room_price');
            const remainingBalanceInput = document.getElementById('remaining_balance');
            const finalPaymentInput = document.getElementById('final_payment');

            function calculateBalances() {
                const roomPrice = parseFloat(roomPriceInput.value) || 0;
                const payment = parseFloat(paymentInput.value) || 0;
                const remainingBalance = roomPrice - payment;
                const finalPayment = payment + remainingBalance;

                remainingBalanceInput.value = remainingBalance.toFixed(2);
                finalPaymentInput.value = finalPayment.toFixed(2);
            }

            paymentInput.addEventListener('input', calculateBalances);

            // Initial calculation on page load
            calculateBalances();
        });
    </script>
@endsection
