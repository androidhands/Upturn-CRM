import React, { useState, useEffect } from 'react';

const SuccessMessage = ({ children }) => {
  const [showMessage, setShowMessage] = useState(false);

  useEffect(() => {
    if (children) {
      setShowMessage(true);
      const timer = setTimeout(() => {
        setShowMessage(false);
      }, 3000); // Display for 3 seconds
      return () => clearTimeout(timer); // Cleanup timer
    }
  }, [children]);

  return (
    showMessage && (
      <div
        className={`bg-emerald-500 py-4 px-2 text-white rounded shadow transition-opacity duration-1000 ease-in-out mb-4 ${
          showMessage ? 'opacity-100' : 'opacity-0'
        }`}
      >
        {children}
      </div>
    )
  );
};

export default SuccessMessage;
