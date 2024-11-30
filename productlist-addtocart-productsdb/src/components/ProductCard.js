import React, { useState } from "react";
import { useCart } from "./cart/CartContext";
import { Modal, Button } from "react-bootstrap"; // Import Modal and Button from Bootstrap

const ProductCard = ({ product }) => {
  const { addToCart } = useCart();
  const [showAddToCartModal, setShowAddToCartModal] = useState(false); // State to handle Add to Cart modal visibility
  const [showDetailsModal, setShowDetailsModal] = useState(false); // State to handle View Details modal visibility

  // Handle Add to Cart action
  const handleAddToCart = () => {
    addToCart(product);
    setShowAddToCartModal(false); // Close the add to cart modal after confirming
  };

  return (
    <div className="card" style={{ height: "100%" }}>
      <div className="card-body d-flex flex-column">
        <h5 className="card-title">{product.barcode}</h5> {/* Display barcode as title */}
        <p className="card-text">
          Price: ₱{product.price} <br />
          Available: {product.quantity} <br />
        </p>

        {/* Container for the buttons */}
        <div className="d-flex justify-content-between mt-auto">
          <button className="btn btn-primary px-2" onClick={() => setShowAddToCartModal(true)}>
            Add to Cart
          </button>
          <button className="btn btn-secondary px-2" onClick={() => setShowDetailsModal(true)}>
            View Details
          </button>
        </div>
      </div>

      {/* Add to Cart Confirmation Modal */}
      <Modal show={showAddToCartModal} onHide={() => setShowAddToCartModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Confirm Add to Cart</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          Are you sure you want to add this product to your cart?
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowAddToCartModal(false)}>
            Cancel
          </Button>
          <Button variant="primary" onClick={handleAddToCart}>
            Confirm
          </Button>
        </Modal.Footer>
      </Modal>

      {/* View Details Modal */}
      <Modal show={showDetailsModal} onHide={() => setShowDetailsModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>{product.barcode}</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <p><strong>Barcode:</strong> {product.barcode}</p>
          <p><strong>Description:</strong> {product.description}</p>
          <p><strong>Price:</strong> ₱{product.price}</p>
          <p><strong>Available Quantity:</strong> {product.quantity}</p>
          <p><strong>Category:</strong> {product.category}</p>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowDetailsModal(false)}>
            Close
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default ProductCard;
