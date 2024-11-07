<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';                // Zamówienie oczekuje na przetworzenie
    case PendingPayment = 'pending_payment'; // Oczekuje na płatność
    case Paid = 'paid';                      // Opłacone
    case Processing = 'processing';          // Zamówienie jest przetwarzane
    case Shipped = 'shipped';                // Zamówienie zostało wysłane
    case Delivered = 'delivered';            // Zamówienie dostarczone
    case Cancelled = 'cancelled';            // Zamówienie zostało anulowane
    case Returned = 'returned';              // Zamówienie zwrócone
}
