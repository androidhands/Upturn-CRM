import React from "react"; // Remove useState since we won't need it

const ToggleSwitch = ({ label, value, onChange, name }) => {
    const handleToggle = () => {
        if (onChange) {
            onChange(name, !value); // Pass the name and new value
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
                aria-checked={value}
                onClick={handleToggle}
                className={`
                    relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent
                    transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2
                    ${value ? "bg-green-600" : "bg-green-200"}
                `}
            >
                <span className="sr-only">Toggle switch</span>
                <span
                    className={`
                        pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0
                        transition duration-200 ease-in-out
                        ${value ? "translate-x-5" : "translate-x-0"}
                    `}
                />
            </button>
        </div>
    );
};

export default ToggleSwitch;
