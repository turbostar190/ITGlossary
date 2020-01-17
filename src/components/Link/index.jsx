import React from 'react';
import PropTypes from 'prop-types';

export const Link = props => {
  return (props.src && props.src !== "404")
    ? (
      <li className="collection-item" id="url" style={{ whiteSpace: "pre-line" }}>
        <a href={props.src} target="_blank" rel="noopener noreferrer">
          Check out more information on Wikipedia!
        </a>
      </li>
    )
    : (
      null
    );
};

Link.propTypes = {
  src: PropTypes.string,
};
