import React from 'react';

const SvgWidget = ({ 
  bgClassName = "h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full",
  svgClassName = "w-7 h-7 stroke-green-500",
  strokeWidth = "1.5",
  children 
}) => {
  return (
    <div className={bgClassName}>
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        strokeWidth={strokeWidth}
        className={svgClassName}
      >
        {children}
      </svg>
    </div>
  );
};

export default SvgWidget;