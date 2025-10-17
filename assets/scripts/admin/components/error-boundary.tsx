/**
 * WordPress dependencies
 */
import { Component } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import { useCopyToClipboard } from "@wordpress/compose";

export default class ErrorBoundary extends Component {
  constructor() {
    super(...arguments);

    this.reboot = this.reboot.bind(this);

    this.state = {
      error: null,
    };
  }

  componentDidCatch(error) {
    this.setState({ error });
  }

  reboot() {
    this.props.onError();
  }

  render() {
    const { error } = this.state;

    if (!error) {
      return this.props.children;
    }

    return (
      <sc-alert type="danger" open>
        {error}
      </sc-alert>
    );
  }
}
