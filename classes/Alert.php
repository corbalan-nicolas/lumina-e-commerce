<?php

class Alert
{
  /**
   * Adds a temporary alert message to the session to be shown to the user.
   *
   * @param string $type    The type of alert (e.g., 'success', 'danger', 'warning' or 'info').
   * @param string $message The message content to display.
   *
   * @return void
   */
  public static function addAlert(string $type, string $message): void
  {
    $_SESSION["lumina-alerts"][] = [
      "type" => $type,
      "message" => $message
    ];
  }

  /**
   * Returns the HTML markup for a single alert message.
   *
   * @param array $alertData An associative array with 'type' and 'message' keys.
   *
   * @return string The HTML string representing the alert box.
   */
  public static function printAlert(array $alertData): string
  {
    $html = "
      <div class='alert alert--{$alertData["type"]}' data-alert-rol='container'>
        <p class='alert__message'>{$alertData["message"]}</p>

        <button class='alert__button' type='button' data-alert-rol='close'>
          <span class='icon icon--close'></span>
        </button>
      </div>
    ";

    return $html;
  }

  /**
   * Clears all alert messages stored in the session.
   *
   * @return void
   */
  public static function clearAlerts(): void
  {
    $_SESSION["lumina-alerts"] = [];
  }

  /**
   * Retrieves all alert messages from the session and returns them as HTML.
   * After rendering, it clears the alert list from the session.
   *
   * @return string|null The concatenated HTML of all alerts, or null if there are none.
   */
  public static function getAlerts(): string|null
  {
    $finalString = "";

    if (empty($_SESSION["lumina-alerts"])) {
      return null;
    } else {
      foreach ($_SESSION["lumina-alerts"] as $alert) {
        $finalString .= self::printAlert($alert);
      }

      self::clearAlerts();
      return $finalString;
    }
  }
}
