# Auto Parts Store - Ordering System

**Developer**: Trix Justin A. Aguilar  
**Course**: BSIS 3B  
**Project**: Auto Parts Store Ordering System
---

## Project Structure

```
ordering-system/
├── index.html          # Main store Frontpage
├── compute.php         # Order Process
└── README.md           # Project doc
```


## Usage

### Shopping Process
1. **Browse Products**: View available auto parts on the main page
2. **Select Quantities**: Use the quantity selectors for each item
3. **Calculate Total**: Click the "Calculate total" button to process your order
4. **Review Order**: The system will display a detailed order summary with all calculations

## File Details

### index.html
The main storefront that displays:
- Store header and branding
- Product catalog with images and descriptions
- Quantity selection inputs
- "Calculate total" button

### compute.php
The order processing script that:
- Receives quantity data from the frontend
- Calculates subtotals for each item
- Applies quantity-based discounts
- Calculates bulk discounts (5% for larger orders)
- Applies tax (12%)
- Generates a comprehensive order summary
- Displays order timestamp and all financial breakdowns

## Discount System

The ordering system includes a comprehensive discount structure:

1. **Quantity Discounts**: Applied based on the quantity of individual items purchased
2. **Bulk Discount**: 5% discount applied to the subtotal after item discounts
3. **Tax Calculation**: 12% tax applied to the discounted subtotal

### Calculation Flow
1. Calculate total before discounts
2. Apply quantity-based discounts per item
3. Calculate subtotal after item discounts
4. Apply 5% bulk discount
5. Calculate 12% tax on discounted amount
6. Display final gross total

