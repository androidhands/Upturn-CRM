import React, { useState } from "react";

const ToggleSwitch = ({ label, initialState = false, onChange }) => {
    const [isChecked, setIsChecked] = useState(initialState);

    const handleToggle = () => {
        const newState = !isChecked;
        setIsChecked(newState);
        if (onChange) {
            onChange(newState);
        }
    };

    return (
        <div className="flex items-center gap-3">
            {label && (
                <span className="block font-medium text-l text-gray-700 dark:text-gray-300">
                    {label}
                </span>
            )}
            <button
                type="button"
                role="switch"
                aria-checked={isChecked}
                onClick={handleToggle}
                className={`
          relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent
          transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2
          ${isChecked ? "bg-green-600" : "bg-green-200"}
        `}
            >
                <span className="sr-only">Toggle switch</span>
                <span
                    className={`
            pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0
            transition duration-200 ease-in-out
            ${isChecked ? "translate-x-5" : "translate-x-0"}
          `}
                />
            </button>
        </div>
    );
};

// Example usage
/* const Example = () => {
  const handleChange = (checked) => {
    console.log('Switch toggled:', checked);
  };

  return (
    <div className="p-4 space-y-4">
      <Switch
        label="Notifications"
        initialState={true}
        onChange={handleChange}
      />
      <Switch
        label="Dark Mode"
        initialState={false}
        onChange={handleChange}
      />
    </div>
  );
}; */

export default ToggleSwitch;
