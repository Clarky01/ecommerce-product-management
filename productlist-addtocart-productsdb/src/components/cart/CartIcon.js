import React from "react";
import { useCart } from "./CartContext"; // Import the useCart hook to get the cart data
import { FaShoppingCart } from "react-icons/fa"; // Import the cart icon from react-icons

const CartIcon = () => {
  const { getCartCount } = useCart(); // Using the useCart hook to get the total cart count
  const cartCount = getCartCount(); // Get the current total count of items in the cart

  return (
    <button className="btn btn-danger d-flex align-items-center position-relative">
      <FaShoppingCart size={20} />

      {/* If there are items in the cart, show a badge with the count */}
      {cartCount > 0 && (
        <div
          style={{
            position: "absolute",
            bottom: "-5px", // Position the badge at the bottom-right corner
            right: "-5px", // Position the badge at the bottom-right corner
            backgroundColor: "yellow", // Badge background color
            borderRadius: "50%", // Make the badge circular
            width: "18px", // Set a fixed width to make it circular
            height: "18px", // Set a fixed height to make it circular
            display: "flex", // Use flex to center the content
            justifyContent: "center", // Center horizontally
            alignItems: "center", // Center vertically
            fontSize: "10px", // Smaller font size for better fit
            color: "black", // Text color inside the badge
            fontWeight: "bold", // Make the number bold for clarity
          }}
        >
          {cartCount} {/* Show the number of items in the cart */}
        </div>
      )}
    </button>
  );
};

export default CartIcon;
