<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->unique()->nullable()->after('id');
            $table->string('barcode')->nullable()->after('sku');
            $table->decimal('cost_price', 10, 2)->default(0)->after('price');
            $table->integer('min_stock')->default(0)->after('stock');

            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null')->after('min_stock');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null')->after('category_id');
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null')->after('supplier_id');
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null')->after('warehouse_id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['warehouse_id']);
            $table->dropForeign(['unit_id']);

            $table->dropColumn(['unit_id','warehouse_id','supplier_id','category_id','min_stock','cost_price','barcode','sku']);
        });
    }
};
