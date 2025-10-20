import { useLink } from "./useLink";

export const Link = ({ as: Component = 'a', params, children, className, style, ...rest }) => {
  const { href, onClick } = useLink(params);

  return (
    <Component
      href={href}
      onClick={onClick}
      className={className}
      style={style}
      {...rest}
    >
      {children}
    </Component>
  );
};
