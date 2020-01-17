import React from 'react';
import PropTypes from "prop-types";

export const Def = props => {
  return (
    <li className="collection-item" id="def"
        style={{ whiteSpace: "pre-line" }}
        dangerouslySetInnerHTML={{ __html: props.txt }}
    />
  );
};

Def.propTypes = {
  txt: PropTypes.string.isRequired,
};
