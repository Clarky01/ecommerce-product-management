import React, { createContext, useState, useContext } from "react";

// Create CartContext
const CartContext = createContext();

// CartProvider component to wrap the app and provide cart data and functions
export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState([]); // Store cart items in state

  // Add item to the cart or increase quantity if it already exists
  const addToCart = (product) => {
    setCart((prevCart) => {
      const productIndex = prevCart.findIndex((item) => item.id === product.id);
      if (productIndex !== -1) {
        const updatedCart = [...prevCart];
        updatedCart[productIndex].quantity += 1; // Increase quantity if product already in cart
        return updatedCart;
      } else {
        return [...prevCart, { ...product, quantity: 1 }]; // Add new product to cart
      }
    });
  };

  // Remove item from the cart
  const removeFromCart = (productId) => {
    setCart((prevCart) => prevCart.filter(item => item.id !== productId));
  };

  // Get the total count of items in the cart
  const getCartCount = () => {
    return cart.reduce((total, item) => total + item.quantity, 0);
  };

  // Provide cart data and functions to the children components
  return (
    <CartContext.Provider value={{ cart, addToCart, removeFromCart, getCartCount }}>
      {children}
    </CartContext.Provider>
  );
};

// Custom hook to use the CartContext
export const useCart = () => useContext(CartContext);
