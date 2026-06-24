<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\TransactionController;
use ReflectionMethod;

class ReceiptTotalExtractorTest extends TestCase
{
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new TransactionController();
    }

    private function callExtractTotal($text)
    {
        $method = new ReflectionMethod(TransactionController::class, 'extractTotalFromText');
        $method->setAccessible(true);
        return $method->invoke($this->controller, $text);
    }

    /**
     * Test extraction from a typical supermarket receipt with cash/change traps.
     */
    public function test_supermarket_receipt_extraction()
    {
        $text = "
        INDOMARET COKLAT
        ================
        INDOMIE GORENG    3.000
        ROTI SHARON       8.500
        SARI ROTI TWR    15.000
        ----------------
        TOTAL BELANJA    26.500
        TUNAI            50.000
        KEMBALI          23.500
        ================
        Tgl. 24-06-2026 12:30:15
        ";

        $total = $this->callExtractTotal($text);
        $this->assertEquals(26500, $total);
    }

    /**
     * Test extraction from a cafe receipt with service charge, tax, grand total, and payment details.
     */
    public function test_cafe_receipt_extraction()
    {
        $text = "
        Kopi Kenangan Mantan
        --------------------
        2x Es Kopi Susu    36.000
        1x Roti Coklat     12.000
        Subtotal           48.000
        PB1 (10%)           4.800
        Grand Total        52.800
        Bayar (OVO)        52.800
        Kembalian               0
        ";

        $total = $this->callExtractTotal($text);
        $this->assertEquals(52800, $total);
    }

    /**
     * Test extraction from a receipt with different currency formats (e.g. Rp prefix, commas, and cents).
     */
    public function test_currency_formatting_extraction()
    {
        $text = "
        Total Tagihan: Rp 150.250,00
        Bayar: Rp. 200.000
        Kembali: Rp 49.750
        ";

        $total = $this->callExtractTotal($text);
        $this->assertEquals(150250, $total);
    }

    /**
     * Test extraction from a receipt with "total bayar" (special case that contains bayar but represents total).
     */
    public function test_total_bayar_extraction()
    {
        $text = "
        Total Bayar: 78.000
        CASH: 100.000
        KEMBALIAN: 22.000
        ";

        $total = $this->callExtractTotal($text);
        $this->assertEquals(78000, $total);
    }

    /**
     * Test fallback to largest logical number when no keywords are present.
     */
    public function test_fallback_largest_number()
    {
        $text = "
        Item A  15.000
        Item B  25.000
        Item C  95.000
        24/06/2026
        Inv #9823412
        ";

        $total = $this->callExtractTotal($text);
        // Should find 95000 (largest non-date number below 10,000,000 and not associated with negative keywords)
        $this->assertEquals(95000, $total);
    }
}
