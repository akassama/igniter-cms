<!-- Product Data JSON Samples Modal -->
<div class="modal fade" id="productJsonDataModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Data JSON Examples</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p>This is a basic example of how to use json structure to add data for specifications, attributes, seller info, and purchase options.</p>
                <div class="contents">
                    <code data-syntax-language="tabbed">
                        <!--specifications json-->
                        <div data-syntax-language="javascript" data-syntax-tab-contents="{ 'title': 'Specifications JSON', 'description': 'Example specifications structure.' }">
                            <pre>
                                {
                                    "size": "XL",
                                    "color": "Blue",
                                    "material": "Cotton",
                                    "weight": "300g",
                                    "dimensions": "10x20x30 cm"
                                }
                            </pre>
                        </div>

                        <!--attributes json-->
                        <div data-syntax-language="javascript" data-syntax-tab-contents="{ 'title': 'Attributes JSON', 'description': 'Example attributes structure.' }">
                            <pre>
                                {
                                    "features": ["Waterproof", "Dustproof"],
                                    "included_items": ["Manual", "Warranty Card"],
                                    "warranty": "1 Year Limited",
                                    "certifications": ["CE", "ISO 9001"]
                                }
                            </pre>
                        </div>

                        <!--seller_info json-->
                        <div data-syntax-language="javascript" data-syntax-tab-contents="{ 'title': 'Seller Info JSON', 'description': 'Example seller_info structure.' }">
                            <pre>
                                {
                                    "name": "Store Name",
                                    "contact_person": "John Doe",
                                    "phone": "+1234567890",
                                    "email": "contact@store.com",
                                    "location": "City, Country"
                                }
                            </pre>
                        </div>

                        <!--purchase_options json-->
                        <div data-syntax-language="javascript" data-syntax-tab-contents="{ 'title': 'Purchase Options JSON', 'description': 'Example purchase_options structure.' }">
                            <pre>
                            [
                                {
                                    "platform": "Amazon",
                                    "url": "https://amazon.com/product",
                                    "price": "299.99",
                                    "availability": "In Stock"
                                },
                                {
                                    "platform": "Official Store",
                                    "url": "https://store.com/product",
                                    "price": "285.99",
                                    "availability": "2-3 days"
                                }
                            ]
                            </pre>
                        </div>

                    </code>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>