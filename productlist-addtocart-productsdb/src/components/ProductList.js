import React, { useState, useEffect } from "react";
import ProductCard from "./ProductCard";
import axios from "axios";

const ProductList = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [searchQuery, setSearchQuery] = useState(""); // Search query for barcode

  // Fetch products from the API
  useEffect(() => {
    const fetchProducts = async () => {
      try {
        const response = await axios.get("http://localhost:8000/api/products"); // Corrected API URL
        const filteredProducts = response.data.map((product) => ({
          barcode: product.barcode,
          description: product.description,
          price: product.price,
          quantity: product.quantity,
          category: product.category,
        }));
        setProducts(filteredProducts);
        setLoading(false);
      } catch (error) {
        setError("Error fetching products");
        setLoading(false);
      }
    };

    fetchProducts();
  }, []); // Empty dependency array, so it runs only once on mount

  // Filter products by barcode that starts with the search query
  const filteredProducts = searchQuery
    ? products.filter((product) =>
        product.barcode.toLowerCase().startsWith(searchQuery.toLowerCase()) // Match barcodes that start with the search query
      )
    : products; // Show all products if the search query is empty

  if (loading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  return (
    <div>
      <input
        type="text"
        placeholder="Search by barcode"
        value={searchQuery}
        onChange={(e) => setSearchQuery(e.target.value)}
        style={{ marginBottom: "20px" }}
        className="form-control mb-4"
      />
      <div className="row">
        {filteredProducts.length > 0 ? (
          filteredProducts.map((product) => (
            <div className="col-md-4 mb-4" key={product.barcode}>
              <ProductCard product={product} />
            </div>
          ))
        ) : (
          <div>No products found</div> // Display a message when no products match the search query
        )}
      </div>
    </div>
  );
};

export default ProductList;
