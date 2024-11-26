import * as React from "react";
const SvgProduct = (props) => (
    <svg
        xmlns="http://www.w3.org/2000/svg"
        xmlSpace="preserve"
        width="1em"
        height="1em"
        fill="currentColor"
        style={{
            fillRule: "evenodd",
            clipRule: "evenodd",
            strokeLinejoin: "round",
            strokeMiterlimit: 2,
        }}
        viewBox="0 0 32 32"
        {...props}
    >
        <path d="M15.009 13.871A7.504 7.504 0 0 0 4 20.5c0 4.139 3.361 7.5 7.5 7.5a7.47 7.47 0 0 0 5.213-2.11 6.48 6.48 0 0 0 4.79 2.11h.003A6.493 6.493 0 0 0 28 21.506V10.494A6.493 6.493 0 0 0 21.506 4h-.003a6.494 6.494 0 0 0-6.494 6.494zM18.134 17A7.46 7.46 0 0 1 19 20.5a7.46 7.46 0 0 1-1.027 3.788A4.49 4.49 0 0 0 21.503 26h.003A4.494 4.494 0 0 0 26 21.506V17zm-2.099.389a5.502 5.502 0 0 1-7.646 7.646zm-1.413-1.416-7.649 7.649a5.502 5.502 0 0 1 7.649-7.649M26 15v-4.506A4.494 4.494 0 0 0 21.506 6h-.003a4.494 4.494 0 0 0-4.494 4.494V15z" />
    </svg>
);
export default SvgProduct;
