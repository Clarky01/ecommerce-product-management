import React from 'react';
import ReactDOM from 'react-dom';
import { CartProvider } from './components/cart/CartContext';
import App from './App';

ReactDOM.render(
  <CartProvider>
    <App />
  </CartProvider>,
  document.getElementById('root')
);
