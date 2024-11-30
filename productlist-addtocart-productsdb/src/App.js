import React from "react";
import { CartProvider } from "./components/cart/CartContext";
import ProductList from "./components/ProductList";
import Header from "./components/Header"; // Import the Header component
import 'bootstrap/dist/css/bootstrap.min.css';

const App = () => {
  return (
    <CartProvider>
      {/* No padding applied to the header */}
      <Header />
      
      {/* Added a container for padding, which does not affect the header */}
      <div className="container-fluid p-4">
        {/* Product List */}
        <ProductList />
      </div>
    </CartProvider>
  );
};

export default App;
